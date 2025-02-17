<?php

declare(strict_types=1);

namespace Made\Cms\Website\Filament\Resources;

use Filament\Forms\Components\MorphToSelect;
use Filament\Forms\Components\MorphToSelect\Type;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Made\Cms\Models\Settings\WebsiteSetting;
use Made\Cms\News\Filament\Resources\PostResource;
use Made\Cms\News\Models\Post;
use Made\Cms\Page\Filament\Resources\PageResource;
use Made\Cms\Page\Models\Page;
use Made\Cms\Website\Filament\Resources\MenuItemResource\Pages\ManageMenuItemsPage;
use Made\Cms\Website\Models\MenuItem;

class MenuItemResource extends Resource
{
    protected static ?string $model = MenuItem::class;

    protected static ?string $slug = 'menu';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Select::make('location')
                            ->label('Menu locatie')
                            ->options(fn () => collect((new WebsiteSetting)->menu_locations)->mapWithKeys(
                                fn (array $location) => [$location['key'] => $location['name']]
                            )->toArray())
                            ->live()
                            ->required(),

                        MorphToSelect::make('linkable')
                            ->types([
                                Type::make(Page::class)
                                    ->label('Pagina')
                                    ->titleAttribute('name'),
                                Type::make(Post::class)
                                    ->label('Nieuwsbericht')
                                    ->titleAttribute('name'),
                            ]),

                        Select::make('parent_id')
                            ->live()
                            ->nullable()
                            ->hidden(fn (Get $get) => $get('location') === null)
                            ->options(function (Get $get): array {
                                return MenuItem::query()
                                    ->where('location', $get('location'))
                                    ->get()
                                    ->mapWithKeys(fn (MenuItem $menuItem) => [$menuItem->id => $menuItem->getLinkName()])
                                    ->toArray();
                            }),
                    ])
                    ->columnSpan(1),

                Section::make()
                    ->schema([

                        TextInput::make('link')
                            ->nullable(),

                        TextInput::make('title')
                            ->nullable(),

                        TextInput::make('rel')
                            ->nullable(),

                    ])
                    ->columnSpan(1),
            ])
            ->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('location')
                    ->label('Locatie')
                    ->formatStateUsing(fn (string $state) => collect((new WebsiteSetting)->menu_locations)->where('key', $state)->first()['name'])
                    ->description(fn (string $state) => collect((new WebsiteSetting)->menu_locations)->where('key', $state)->first()['description']),

                TextColumn::make('parent.linkable.name')
                    ->label('Parent'),

                TextColumn::make('linkable.name')
                    ->description(fn (MenuItem $record) => $record->linkable->meta?->description ?? null)
                    ->label('Link')
                    ->url(fn (MenuItem $record) => match (get_class($record->linkable)) {
                        Post::class => PostResource::getUrl('edit', ['record' => $record->linkable]),
                        default => PageResource::getUrl('edit', ['record' => $record->linkable]),
                    }),

                TextColumn::make('children_count')
                    ->counts('children'),

                TextColumn::make('link')
                    ->label('Custom link'),

                TextColumn::make('title')
                    ->label('Custom title'),

                TextColumn::make('rel')
                    ->label('Link rel'),

                TextColumn::make('created_at')
                    ->since(),
            ])
            ->defaultSort('index')
            ->reorderable('index')
            ->actions([
                ActionGroup::make([
                    ActionGroup::make([
                        EditAction::make(),
                    ])
                        ->dropdown(false),

                    DeleteAction::make(),
                ]),
            ]);
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
