<?php

declare(strict_types=1);

namespace Made\Cms\Website\Filament\Resources;

use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\MorphToSelect;
use Filament\Forms\Components\MorphToSelect\Type;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;
use Made\Cms\News\Filament\Resources\PostResource;
use Made\Cms\News\Models\Post;
use Made\Cms\News\QueryBuilders\PostQueryBuilder;
use Made\Cms\Page\Filament\Resources\PageResource;
use Made\Cms\Page\Models\Page;
use Made\Cms\Page\QueryBuilders\PageQueryBuilder;
use Made\Cms\Website\Enums\AhrefRel;
use Made\Cms\Website\Enums\Target;
use Made\Cms\Website\Filament\Resources\MenuItemResource\Pages\ManageMenuItemsPage;
use Made\Cms\Website\Models\MenuItem;
use Made\Cms\Website\Models\Settings\WebsiteSetting;

class MenuItemResource extends Resource
{
    protected static ?string $model = MenuItem::class;

    protected static ?string $slug = 'menu';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('made-cms::cms.resources.menuitem.sections.data.heading'))
                    ->description(new HtmlString(__('made-cms::cms.resources.menuitem.sections.data.description')))
                    ->schema([

                        MorphToSelect::make('linkable')
                            ->label(__('made-cms::cms.resources.menuitem.fields.linkable.label'))
                            ->types([

                                Type::make(Page::class)
                                    ->label('Pagina')
                                    ->titleAttribute('name')
                                    ->modifyOptionsQueryUsing(fn (PageQueryBuilder $query) => $query->published()),

                                Type::make(Post::class)
                                    ->label('Nieuwsbericht')
                                    ->titleAttribute('name')
                                    ->modifyOptionsQueryUsing(fn (PostQueryBuilder $query) => $query->published()),

                            ]),


                        TextInput::make('link')
                            ->label(__('made-cms::cms.resources.menuitem.fields.link.label'))
                            ->helperText(new HtmlString(__('made-cms::cms.resources.menuitem.fields.link.helperText')))
                            ->nullable(),

                        TextInput::make('label')
                            ->label(__('made-cms::cms.resources.menuitem.fields.label.label'))
                            ->helperText(new HtmlString(__('made-cms::cms.resources.menuitem.fields.label.helperText')))
                            ->nullable(),

                        TextInput::make('title')
                            ->label(__('made-cms::cms.resources.menuitem.fields.title.label'))
                            ->helperText(new HtmlString(__('made-cms::cms.resources.menuitem.fields.title.helperText')))
                            ->nullable(),

                    ])
                    ->columnSpan(1),

                Section::make(__('made-cms::cms.resources.menuitem.sections.placement.heading'))
                    ->description(__('made-cms::cms.resources.menuitem.sections.placement.description'))
                    ->schema([
                        Select::make('location')
                            ->label(__('made-cms::cms.resources.menuitem.fields.location.label'))
                            ->options(
                                fn () => collect((new WebsiteSetting)->menu_locations)->mapWithKeys(
                                    fn (array $location) => [$location['key'] => $location['name']]
                                )
                                    ->toArray()
                            )
                            ->default(fn ($livewire) => $livewire->activeTab)
                            ->live()
                            ->required(),

                        Select::make('parent_id')
                            ->label(__('made-cms::cms.resources.menuitem.fields.parent_id.label'))
                            ->helperText(__('made-cms::cms.resources.menuitem.fields.parent_id.helperText'))
                            ->live()
                            ->nullable()
                            ->hidden(fn (Get $get) => $get('location') === null)
                            ->options(function (Get $get): array {
                                return MenuItem::query()
                                    ->where('location', $get('location'))
                                    ->get()
                                    ->mapWithKeys(fn (MenuItem $menuItem) => [$menuItem->id => $menuItem->linkName])
                                    ->toArray();
                            }),
                    ])
                    ->columnSpan(1),

                Section::make(__('made-cms::cms.resources.menuitem.sections.extra.heading'))
                    ->description(__('made-cms::cms.resources.menuitem.sections.extra.description'))
                    ->schema([
                        CheckboxList::make('rel')
                            ->label(__('made-cms::cms.resources.menuitem.fields.rel.label'))
                            ->options(
                                fn (): array => collect(AhrefRel::cases())
                                    ->filter(fn (AhrefRel $case) => $case->isSelectableForMenuItems())
                                    ->mapWithKeys(fn (AhrefRel $case) => [$case->value => $case->getLabel()])
                                    ->toArray()
                            )
                            ->descriptions(
                                fn (): array => collect(AhrefRel::cases())
                                    ->filter(fn (AhrefRel $case) => $case->isSelectableForMenuItems())
                                    ->mapWithKeys(fn (AhrefRel $case) => [$case->value => $case->getDescription()])
                                    ->toArray()
                            )
                            ->columns(2)
                            ->nullable(),

                        Select::make('target')
                            ->label(__('made-cms::cms.resources.menuitem.fields.target.label'))
                            ->options(
                                fn (): array => collect(Target::cases())
                                    ->mapWithKeys(fn (Target $target) => [$target->value => $target->getLabel() . ' - ' . $target->getDescription()])
                                    ->toArray()
                            )
                            ->nullable(),
                    ])
                    ->collapsible()
                    ->collapsed()
                    ->columnSpanFull(),
            ])
                ->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('linkable.name')
                    ->description(fn (MenuItem $record) => $record->linkable->meta?->description ?? null)
                    ->label('Gekoppeld')
                    ->url(function (MenuItem $record): ?string {
                        if (empty($record->linkable)) {
                            return null;
                        }

                        return match (get_class($record->linkable)) {
                            Post::class => PostResource::getUrl('edit', ['record' => $record->linkable]),
                            default => PageResource::getUrl('edit', ['record' => $record->linkable]),
                        };
                    }),

                TextColumn::make('title')
                    ->label('Handmatige link')
                    ->description(fn ($record) => $record->link),

                TextColumn::make('parent.linkable.name')
                    ->label('Hoofdpagina'),

                TextColumn::make('children_count')
                    ->label('Onderliggende Pagina\'s')
                    ->counts('children')
                    ->url(
                        fn (MenuItem $record, $livewire) => static::getUrl('index', ['tableFilters' => [
                            'parent_id' => [
                                'value' => $record->id,
                            ],
                        ]])
                    )
                    ->suffix(fn (int $state) => trans_choice(' onderliggende pagina| onderliggende pagina\'s', $state)),

                TextColumn::make('rel')
                    ->label('Rel link attribuut'),

                IconColumn::make('target')
                    ->label('Link target')
                    ->icon(fn (?string $state): string => Target::tryFrom($state)?->getIcon() ?? 'heroicon-o-link'),

                TextColumn::make('location')
                    ->label('Menu')
                    ->formatStateUsing(fn (string $state) => collect((new WebsiteSetting)->menu_locations)->where('key', $state)->first()['name']),

                TextColumn::make('created_at')
                    ->since(),
            ])
            ->defaultSort(function ($query) {
                return $query
                    ->orderBy('parent_id', 'asc')
                    ->orderBy('index', 'asc');
            })
            ->reorderable('index')
            ->actions([
                ActionGroup::make([
                    ActionGroup::make([
                        EditAction::make()
                            ->modalWidth(MaxWidth::SevenExtraLarge),
                    ])
                        ->dropdown(false),

                    DeleteAction::make(),
                ]),
            ])
            ->filters([
                SelectFilter::make('parent_id')
                    ->label('Hoofdpagina')
                    ->options(
                        fn ($livewire): array => MenuItem::query()
                            ->where('location', $livewire->activeTab)
                            ->get()
                            ->mapWithKeys(fn (MenuItem $menuItem) => [$menuItem->id => $menuItem->linkName])
                            ->toArray()
                    ),
            ])
            ->defaultPaginationPageOption(50)
            ->paginated([50, 75, 100, 150, 'all']);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageMenuItemsPage::route('/'),
        ];
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
        return __('made-cms::cms.resources.menuitem.singular');
    }

    /**
     * Retrieves the plural label for the model.
     *
     * @return string The plural label for the model.
     */
    public static function getPluralModelLabel(): string
    {
        return __('made-cms::cms.resources.menuitem.label');
    }

    /**
     * Retrieves the navigation badge for the page.
     *
     * @return string|null The navigation badge representing the count of published pages, or null if not applicable.
     */
    public static function getNavigationBadge(): ?string
    {
        $websiteSettings = app()->make(WebsiteSetting::class);

        return (string) count($websiteSettings->menu_locations);
    }
}
