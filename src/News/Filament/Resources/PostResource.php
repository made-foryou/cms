<?php

declare(strict_types=1);

namespace Made\Cms\News\Filament\Resources;

use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Builder as ComponentsBuilder;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ForceDeleteBulkAction;
use Filament\Tables\Actions\RestoreBulkAction;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Made\Cms\Filament\Resources\ContentStrips;
use Made\Cms\Language\Models\Language;
use Made\Cms\News\Models\Post;
use Made\Cms\Shared\Enums\MetaRobot;
use Made\Cms\Shared\Enums\PublishingStatus;
use Made\Cms\Shared\Filament\Actions\TranslateAction;
use Pboivin\FilamentPeek\Forms\Actions\InlinePreviewAction;

class PostResource extends Resource
{
    use ContentStrips;

    protected static ?string $model = Post::class;

    protected static ?string $slug = 'posts';

    /**
     * Configures the form schema with various tabs and sections for managing post-related data.
     *
     * @param  Form  $form  The form instance to be configured.
     * @return Form The configured form instance.
     */
    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Tabs::make()
                    ->tabs([

                        Tab::make(__('made-cms::cms.resources.post.tabs.post'))
                            ->icon('heroicon-o-pencil')
                            ->schema([

                                Group::make()
                                    ->schema([

                                        Section::make()
                                            ->schema([

                                                TextInput::make('name')
                                                    ->label(__('made-cms::cms.resources.post.fields.name.label'))
                                                    ->helperText(__('made-cms::cms.resources.post.fields.name.helperText'))
                                                    ->required(),

                                                TextInput::make('slug')
                                                    ->label(__('made-cms::cms.resources.post.fields.slug.label'))
                                                    ->helperText(__('made-cms::cms.resources.post.fields.slug.helperText'))
                                                    ->required()
                                                    ->prefix(function (?Post $record): string {
                                                        if ($record === null || $record->parent === null) {
                                                            return '/';
                                                        }

                                                        $parts = $record->urlSchema();

                                                        array_pop($parts);

                                                        return '/' . implode('/', $parts) . '/';
                                                    })
                                                    ->suffixAction(
                                                        Action::make('generate-slug')
                                                            ->label('Maak automatisch een slug aan de hand van de pagina naam.')
                                                            ->icon('heroicon-s-arrow-path')
                                                            ->action(fn(Get $get, Set $set, ?string $state) => $set(
                                                                'slug',
                                                                Str::slug($get('name'))
                                                            ))
                                                    ),

                                                DatePicker::make('date')
                                                    ->label(__('made-cms::cms.resources.post.fields.date.label'))
                                                    ->helperText(__('made-cms::cms.resources.post.fields.date.helperText'))
                                                    ->required()
                                                    ->default(now()),

                                                SpatieMediaLibraryFileUpload::make('featured_image')
                                                    ->collection('featured_image')
                                                    ->image()
                                                    ->imageEditor(),

                                                Textarea::make('introduction')
                                                    ->label(__('made-cms::cms.resources.post.fields.introduction.label'))
                                                    ->helperText(__('made-cms::cms.resources.post.fields.introduction.helperText'))
                                                    ->nullable()
                                                    ->minLength(10)
                                                    ->maxLength(config('made-cms.content.post.introduction_max_length')),

                                            ]),

                                    ])
                                    ->columnSpan(['lg' => 2]),

                                Group::make()
                                    ->schema([

                                        Section::make()
                                            ->schema([

                                                Select::make('status')
                                                    ->label(__('made-cms::cms.resources.post.fields.status.label'))
                                                    ->helperText(__('made-cms::cms.resources.post.fields.status.helperText'))
                                                    ->options(PublishingStatus::options())
                                                    ->default(array_key_first(PublishingStatus::options())),

                                                Select::make('language')
                                                    ->relationship('language', 'name')
                                                    ->preload()
                                                    ->default(
                                                        Language::query()
                                                            ->default()
                                                            ->first()
                                                            ->id
                                                    )
                                                    ->label(__('made-cms::cms.resources.post.fields.locale.label'))
                                                    ->helperText(__('made-cms::cms.resources.post.fields.locale.helperText')),

                                                Select::make('translated_from_id')
                                                    ->label(__('made-cms::cms.resources.post.fields.translated_from.label'))
                                                    ->disabled()
                                                    ->relationship('translatedFrom', 'name')
                                                    ->helperText(__('made-cms::cms.resources.post.fields.translated_from.helperText'))
                                                    ->visible(fn(Get $get) => $get('translated_from_id') !== null),

                                            ]),

                                    ]),

                            ])
                            ->columns(3),

                        Tabs\Tab::make(__('made-cms::cms.resources.post.tabs.content'))
                            ->icon('heroicon-s-rectangle-group')
                            ->schema([

                                Section::make(__('made-cms::cms.resources.post.fields.content.label'))
                                    ->description(__('made-cms::cms.resources.post.fields.content.helperText'))
                                    ->icon('heroicon-s-rectangle-group')
                                    ->schema([

                                        Actions::make([
                                            InlinePreviewAction::make()
                                                ->label(__('made-cms::cms.resources.post.actions.preview_builder.label'))
                                                ->builderName('content'),
                                        ])
                                            ->columnSpanFull()
                                            ->alignEnd(),

                                        self::contentBuilderField(),

                                    ]),

                            ]),

                        Tabs\Tab::make(__('made-cms::cms.resources.post.tabs.meta'))
                            ->icon('heroicon-s-adjustments-horizontal')
                            ->schema([

                                Section::make(__('made-cms::cms.resources.meta.sections.post_meta.title'))
                                    ->description(__('made-cms::cms.resources.meta.sections.post_meta.description'))
                                    ->relationship('meta')
                                    ->schema([

                                        TextInput::make('title')
                                            ->label(__('made-cms::cms.resources.post.fields.meta.title.label'))
                                            ->helperText(__('made-cms::cms.resources.post.fields.meta.title.helperText'))
                                            ->maxLength(60),

                                        Textarea::make('description')
                                            ->label(__('made-cms::cms.resources.post.fields.meta.description.label'))
                                            ->helperText(__('made-cms::cms.resources.post.fields.meta.description.helperText'))
                                            ->maxLength(160),

                                    ])
                                    ->columnSpan(['lg' => 2]),

                                Section::make(__('made-cms::cms.resources.meta.sections.meta.title'))
                                    ->description(__('made-cms::cms.resources.meta.sections.meta.description'))
                                    ->relationship('meta')
                                    ->collapsed()
                                    ->schema([

                                        Select::make('robot')
                                            ->label(__('made-cms::cms.resources.post.fields.meta.robot.label'))
                                            ->helperText(__('made-cms::cms.resources.post.fields.meta.robot.helperText'))
                                            ->options(MetaRobot::options())
                                            ->default(MetaRobot::IndexAndFollow->value),

                                        Select::make('canonicals')
                                            ->label(__('made-cms::cms.resources.post.fields.meta.canonicals.label'))
                                            ->helperText(__('made-cms::cms.resources.post.fields.meta.canonicals.helperText'))
                                            ->multiple()
                                            ->options(
                                                Post::select(['id', 'name'])
                                                    ->get()
                                                    ->mapWithKeys(fn($page) => [$page->id => $page->name])
                                            ),

                                    ])
                                    ->columnSpan(['lg' => 1]),

                            ])
                            ->columns(3),

                    ])
                    ->contained(false)
                    ->columnSpanFull(),
            ]);
    }

    public static function contentBuilderField(string $context = 'form'): ComponentsBuilder
    {
        return ComponentsBuilder::make('content')
            ->label('')
            ->addActionLabel(__('made-cms::cms.resources.post.fields.content.add_button'))
            ->collapsible()
            ->collapsed()
            ->blocks(self::contentStrips(Post::class));
    }

    /**
     * Configures the table structure, columns, filters, actions, and other settings for the resource.
     *
     * @param  Table  $table  The table instance to configure.
     * @return Table The configured table instance.
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                SpatieMediaLibraryImageColumn::make('featured_image')
                    ->label('Afbeelding')
                    ->collection('featured_image')
                    ->conversion('preview')
                    ->circular(),

                TextColumn::make('date')
                    ->label(__('made-cms::cms.resources.post.table.date'))
                    ->sortable()
                    ->date(),

                TextColumn::make('name')
                    ->weight(FontWeight::Bold)
                    ->searchable()
                    ->sortable(),

                SpatieMediaLibraryImageColumn::make('language.flag')
                    ->collection('flag')
                    ->label(__('made-cms::cms.resources.page.table.locale'))
                    ->size(20)
                    ->circular(),

                TextColumn::make('status')
                    ->label(__('made-cms::cms.resources.page.table.status'))
                    ->badge()
                    ->color(fn(PublishingStatus $state) => $state->color())
                    ->formatStateUsing(fn(PublishingStatus $state) => $state->label()),

                TextColumn::make('translatedFrom.name')
                    ->label('Vertaling van')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('createdBy.name'),

                TextColumn::make('updated_at')
                    ->label(__('made-cms::cms.resources.page.table.updated_at'))
                    ->since(),
            ])
            ->heading('Nieuwsberichten')
            ->description('Hier vind je alle nieuwsberichten die aan de website zijn toegevoegd of de nieuwsberichten ook zichtbaar zijn voor bezoekers is afhankelijk van hun status.')
            ->filters([
                SelectFilter::make('language_id')
                    ->relationship('language', 'name')
                    ->label(__('made-cms::cms.resources.page.filters.locale.label')),

                SelectFilter::make('translated_from_id')
                    ->options(Post::query()->get()->mapWithKeys(fn($post) => [$post->id => $post->name]))
                    ->label('Vertaling van'),

                TrashedFilter::make(),
            ])
            ->actions([
                ActionGroup::make([
                    ActionGroup::make([
                        TranslateAction::make(),
                        EditAction::make(),
                    ])
                        ->dropdown(false),

                    DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                ]),
            ])
            ->defaultPaginationPageOption(50)
            ->defaultSort('date', 'desc');
    }

    /**
     * Returns an array of page routes for the resource.
     *
     * @return array An associative array where keys represent page types (e.g., 'index', 'create', 'edit')
     */
    public static function getPages(): array
    {
        return [
            'index' => \Made\Cms\News\Filament\Resources\PostResource\Pages\ListPosts::route('/'),
            'create' => \Made\Cms\News\Filament\Resources\PostResource\Pages\CreatePost::route('/create'),
            'edit' => \Made\Cms\News\Filament\Resources\PostResource\Pages\EditPost::route('/{record}/edit'),
        ];
    }

    /**
     * Retrieves the Eloquent query builder instance for the resource with specific global scopes removed.
     *
     * @return Builder The Eloquent query builder instance with modified scope behavior.
     */
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    /**
     * Retrieves the attributes that are globally searchable within the application.
     *
     * @return array An array of attribute names that can be searched globally.
     */
    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'slug'];
    }

    /**
     * Retrieves the navigation label for the resource.
     *
     * @return string The navigation label.
     */
    public static function getNavigationLabel(): string
    {
        return __('made-cms::cms.resources.post.label');
    }

    /**
     * Retrieves the plural label for the resource.
     *
     * @return string|null The plural label if defined, or null otherwise.
     */
    public static function getPluralLabel(): ?string
    {
        return __('made-cms::cms.resources.post.label');
    }

    /**
     * Retrieves the model label for the resource.
     *
     * @return string The model label.
     */
    public static function getModelLabel(): string
    {
        return __('made-cms::cms.resources.post.singular');
    }

    /**
     * Retrieves the navigation group for the resource.
     *
     * @return string|null The navigation group if defined, or null otherwise.
     */
    public static function getNavigationGroup(): ?string
    {
        return __('made-cms::cms.navigation_groups.news');
    }

    /**
     * Retrieves the navigation badge count for published posts.
     *
     * @return string|null The count of published posts as a string, or null if unavailable.
     */
    public static function getNavigationBadge(): ?string
    {
        return (string) Post::query()->published()->count();
    }
}
