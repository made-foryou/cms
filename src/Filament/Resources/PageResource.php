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
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Made\Cms\Enums\MetaRobot;
use Made\Cms\Enums\PageStatus;
use Made\Cms\Filament\Resources\PageResource\Pages;
use Made\Cms\Models\Page;

class PageResource extends Resource
{
    use ContentStrips;

    protected static ?string $model = Page::class;

    protected static ?string $slug = 'pages';

    protected static ?string $navigationIcon = 'heroicon-s-globe-alt';

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

                                                TextInput::make('slug')
                                                    ->label(__('made-cms::pages.fields.slug.label'))
                                                    ->helperText(__('made-cms::pages.fields.slug.description'))
                                                    ->required()
                                                    ->prefix('/')
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
                                                    ->options(PageStatus::options()),
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
                                            ->blocks(self::contentStrips()),
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
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('slug')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('author.name'),

                TextColumn::make('updated_at')
                    ->since(),
            ])
            ->filters([
                SelectFilter::make('locale')
                    ->label(__('made-cms::cms.resources.page.filters.locale.label')),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
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
        return __('made-cms::cms.groups.website_management');
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
