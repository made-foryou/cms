<?php

namespace Made\Cms\Filament\Resources;

use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Made\Cms\Enums\MetaRobot;
use Made\Cms\Filament\Resources\PageResource\Pages;
use Made\Cms\Language\Models\Language;
use Made\Cms\Page\Models\Page;
use Made\Cms\Shared\Enums\PublishingStatus;
use Made\Cms\Shared\Filament\Actions\TranslateAction;

class PageResource extends Resource
{
    use ContentStrips;

    protected static ?string $model = Page::class;

    protected static ?string $slug = 'pages';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make()
                    ->tabs([

                        Tabs\Tab::make(__('made-cms::pages.tabs.page'))
                            ->icon('heroicon-s-pencil')
                            ->schema([
                                Group::make()
                                    ->schema([
                                        Section::make()
                                            ->schema([
                                                TextInput::make('name')
                                                    ->label(__('made-cms::pages.fields.name.label'))
                                                    ->helperText(__('made-cms::pages.fields.name.description'))
                                                    ->required(),

                                                Select::make('parent_id')
                                                    ->label('Onderdeel van')
                                                    ->helperText('Deze pagina valt onder de hierboven geselecteerde pagina.')
                                                    ->relationship(name: 'parent', titleAttribute: 'name', ignoreRecord: true)
                                                    ->preload()
                                                    ->searchable(),

                                                TextInput::make('slug')
                                                    ->label(__('made-cms::pages.fields.slug.label'))
                                                    ->helperText(__('made-cms::pages.fields.slug.description'))
                                                    ->required()
                                                    ->prefix(function (?Page $record): string {
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
                                                            ->action(fn (Get $get, Set $set, ?string $state) => $set(
                                                                'slug',
                                                                Str::slug($get('name'))
                                                            ))
                                                    ),
                                            ]),
                                    ])
                                    ->columnSpan(['lg' => 2]),

                                Group::make()
                                    ->schema([
                                        Section::make()
                                            ->schema([

                                                Select::make('status')
                                                    ->label(__('made-cms::pages.fields.status.label'))
                                                    ->helperText(__('made-cms::pages.fields.status.description'))
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
                                                    ->label(__('made-cms::cms.resources.page.fields.locale.label'))
                                                    ->helperText(__('made-cms::cms.resources.page.fields.locale.description')),

                                                Select::make('translated_from_id')
                                                    ->label('Vertaling van')
                                                    ->disabled()
                                                    ->relationship('translatedFrom', 'name')
                                                    ->helperText('Deze pagina is een vertaling van de hierboven geselecteerde pagina. Dit is niet te wijzigen.')
                                                    ->visible(fn (Get $get) => $get('translated_from_id') !== null),
                                            ]),
                                    ]),
                            ])
                            ->columns(3),

                        Tabs\Tab::make(__('made-cms::pages.tabs.content'))
                            ->icon('heroicon-s-rectangle-group')
                            ->schema([
                                Section::make(__('made-cms::pages.fields.content.label'))
                                    ->description(__('made-cms::pages.fields.content.description'))
                                    ->icon('heroicon-s-rectangle-group')
                                    ->schema([
                                        \Filament\Forms\Components\Builder::make('content')
                                            ->label('')
                                            ->addActionLabel(__('made-cms::pages.fields.content.add_button'))
                                            ->collapsible()
                                            ->collapsed()
                                            ->blockPreviews()
                                            ->blocks(self::contentStrips(Page::class)),
                                    ]),
                            ]),

                        Tabs\Tab::make(__('made-cms::cms.resources.page.tabs.meta'))
                            ->icon('heroicon-s-adjustments-horizontal')
                            ->schema([
                                Section::make(__('made-cms::cms.resources.meta.sections.page_meta.title'))
                                    ->description(__('made-cms::cms.resources.meta.sections.page_meta.description'))
                                    ->relationship('meta')
                                    ->schema([
                                        TextInput::make('title')
                                            ->label(__('made-cms::cms.resources.meta.title.label'))
                                            ->helperText(__('made-cms::cms.resources.meta.title.description'))
                                            ->maxLength(60),

                                        Textarea::make('description')
                                            ->label(__('made-cms::cms.resources.meta.description.label'))
                                            ->helperText(__('made-cms::cms.resources.meta.description.description'))
                                            ->maxLength(160),
                                    ])
                                    ->columnSpan(['lg' => 2]),

                                Section::make(__('made-cms::cms.resources.meta.sections.meta.title'))
                                    ->description(__('made-cms::cms.resources.meta.sections.meta.description'))
                                    ->relationship('meta')
                                    ->collapsed()
                                    ->schema([
                                        Select::make('robot')
                                            ->label(__('made-cms::cms.resources.meta.robot.label'))
                                            ->helperText(__('made-cms::cms.resources.meta.robot.description'))
                                            ->options(MetaRobot::options())
                                            ->default(MetaRobot::IndexAndFollow->value),

                                        Select::make('canonicals')
                                            ->label(__('made-cms::cms.resources.meta.canonicals.label'))
                                            ->helperText(__('made-cms::cms.resources.meta.canonicals.description'))
                                            ->multiple()
                                            ->options(
                                                Page::select(['id', 'name'])
                                                    ->get()
                                                    ->mapWithKeys(fn ($page) => [$page->id => $page->name])
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

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('parent.name')
                    ->label('Bovenliggende pagina')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('name')
                    ->label(__('made-cms::cms.resources.page.table.name'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('language.name')
                    ->label(__('made-cms::cms.resources.page.table.locale'))
                    ->icon(fn (Page $record) => ($record->language?->image ? Storage::url($record->language->image) : '')),

                TextColumn::make('status')
                    ->label(__('made-cms::cms.resources.page.table.status'))
                    ->badge()
                    ->color(fn (PublishingStatus $state) => $state->color())
                    ->formatStateUsing(fn (PublishingStatus $state) => $state->label()),

                TextColumn::make('slug')
                    ->label(__('made-cms::cms.resources.page.table.slug'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('createdBy.name')
                    ->label(__('made-cms::cms.resources.page.table.created_by')),

                TextColumn::make('updated_at')
                    ->label(__('made-cms::cms.resources.page.table.updated_at'))
                    ->since(),
            ])
            ->filters([
                SelectFilter::make('language_id')
                    ->relationship('language', 'name')
                    ->label(__('made-cms::cms.resources.page.filters.locale.label')),

                SelectFilter::make('parent_id')
                    ->options(Page::query()->get()->mapWithKeys(fn ($page) => [$page->id => $page->name]))
                    ->label('Bovenliggende pagina'),
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
                ]),
            ])
            ->defaultPaginationPageOption(50)
            ->reorderable('sort')
            ->defaultSort(function ($query) {
                return $query
                    ->orderBy('parent_id', 'asc')
                    ->orderBy('sort', 'asc');
            });
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['author']);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'slug', 'author.name'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        $details = [];

        if ($record->author) {
            $details['Author'] = $record->author->name;
        }

        return $details;
    }

    /**
     * Retrieves the navigation group for the website management section.
     *
     * @return string|null The navigation group label for website management, or null if not set.
     */
    public static function getNavigationGroup(): ?string
    {
        return __('made-cms::cms.navigation_groups.website');
    }

    /**
     * Retrieves the singular label for the model.
     *
     * @return string The singular label for the model.
     */
    public static function getModelLabel(): string
    {
        return __('made-cms::cms.resources.page.singular');
    }

    /**
     * Retrieves the plural label for the model.
     *
     * @return string The plural label for the model.
     */
    public static function getPluralModelLabel(): string
    {
        return __('made-cms::cms.resources.page.label');
    }
}
