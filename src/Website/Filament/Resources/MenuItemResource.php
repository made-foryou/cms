<?php

declare(strict_types=1);

namespace Made\Cms\Website\Filament\Resources;

use Filament\Forms\Components\MorphToSelect;
use Filament\Forms\Components\MorphToSelect\Type;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Made\Cms\Models\Settings\WebsiteSetting;
use Made\Cms\News\Models\Post;
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
                            ->options(fn () => collect((new WebsiteSetting)->menu_locations)->mapWithKeys(
                                fn (array $location) => [$location['key'] => $location['name']]
                            )->toArray())
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
        return $table;
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
