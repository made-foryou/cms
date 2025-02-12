<?php

namespace Made\Cms\Filament\Pages;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Illuminate\Contracts\Support\Htmlable;
use Made\Cms\Models\Settings\WebsiteSetting;
use Made\Cms\Page\Models\Page;

class WebsiteSettingsPage extends SettingsPage
{
    /**
     * The settings model for saving and retrieving the data from
     * the database.
     */
    protected static string $settings = WebsiteSetting::class;

    /**
     * The sort order for showing the navigation items.
     */
    protected static ?int $navigationSort = 10;

    /**
     * Processes and returns the given Form object.
     *
     * @param  Form  $form  The form object to be processed.
     * @return Form The processed form object.
     */
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('made-cms::cms.resources.settings.website.sections.general.title'))
                    ->description(__('made-cms::cms.resources.settings.website.sections.general.description'))
                    ->aside()
                    ->schema([

                        Toggle::make('online')
                            ->label(__('made-cms::cms.resources.settings.website.online.label'))
                            ->helperText(__('made-cms::cms.resources.settings.website.online.description')),

                        Select::make('landing_page')
                            ->label('Landing page')
                            ->helperText('Select the page which will be used for the landing page for this website.')
                            ->options(
                                fn () => Page::query()
                                    ->select(['id', 'name'])
                                    ->get()
                                    ->mapWithKeys(fn (Page $page) => [$page->id => $page->name])
                                    ->toArray()
                            ),

                    ])
                    ->columnSpan(4),

                Section::make('Menu')
                    ->description('Beheer de instellingen van de navigatie menu\'s binnen de website')
                    ->aside()
                    ->schema([
                        Repeater::make('menu_locations')
                            ->label('Menu locaties')
                            ->schema([
                                TextInput::make('key')
                                    ->label('ID')
                                    ->helperText('Aan de hand van deze waarde kan de inhoud van het menu opgehaald worden.')
                                    ->required(),

                                TextInput::make('name')
                                    ->label('Naam')
                                    ->helperText('De naam van de locatie.')
                                    ->required(),

                                Textarea::make('description')
                                    ->label('Omschrijving')
                                    ->helperText('Een korte omschrijving van de menu locatie en waar deze gebruikt wordt.')
                                    ->nullable(),
                            ])
                            ->addActionLabel('Menu locatie toevoegen')
                            ->collapsible()
                            ->collapsed()
                            ->reorderable(false)
                            ->cloneable()
                            ->itemlabel(fn ($state) => $state['name']),
                    ])
                    ->columnSpan(4),
            ])
            ->columns(5);
    }

    /**
     * Retrieves the navigation label for the website settings.
     *
     * @return string The navigation label.
     */
    public static function getNavigationLabel(): string
    {
        return __('made-cms::cms.resources.settings.website.label');
    }

    /**
     * Retrieves and returns the navigation group string for website management.
     *
     * @return string The navigation group string.
     */
    public static function getNavigationGroup(): string
    {
        return __('made-cms::cms.navigation_groups.website');
    }

    public function getTitle(): string | Htmlable
    {
        return __('made-cms::cms.resources.settings.website.title');
    }
}
