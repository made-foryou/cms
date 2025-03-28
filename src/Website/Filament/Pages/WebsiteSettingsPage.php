<?php

namespace Made\Cms\Website\Filament\Pages;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Illuminate\Contracts\Support\Htmlable;
use Made\Cms\Page\Models\Page;
use Made\Cms\Website\Models\Settings\WebsiteSetting;

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
                            ->label(__('made-cms::cms.resources.settings.website.fields.online.label'))
                            ->helperText(__('made-cms::cms.resources.settings.website.fields.online.helperText')),

                        Select::make('landing_page')
                            ->label(__('made-cms::cms.resources.settings.website.fields.landing_page.label'))
                            ->helperText(__('made-cms::cms.resources.settings.website.fields.landing_page.helperText'))
                            ->options(
                                fn () => Page::query()
                                    ->published()
                                    ->select(['id', 'name'])
                                    ->get()
                                    ->mapWithKeys(fn (Page $page) => [$page->id => $page->name])
                                    ->toArray()
                            ),

                        Select::make('not_found_page')
                            ->label(__('made-cms::cms.resources.settings.website.fields.not_found_page.label'))
                            ->helperText(__('made-cms::cms.resources.settings.website.fields.not_found_page.helperText'))
                            ->options(
                                fn () => Page::query()
                                    ->published()
                                    ->select(['id', 'name'])
                                    ->get()
                                    ->mapWithKeys(fn (Page $page) => [$page->id => $page->name])
                                    ->toArray()
                            ),

                    ])
                    ->columnSpan(4),

                Section::make(__('made-cms::cms.resources.settings.website.sections.menulocations.title'))
                    ->description(__('made-cms::cms.resources.settings.website.sections.menulocations.description'))
                    ->aside()
                    ->schema([
                        Repeater::make('menu_locations')
                            ->hiddenLabel()
                            ->schema([
                                TextInput::make('key')
                                    ->label(__('made-cms::cms.resources.settings.website.fields.menu_locations.fields.key.label'))
                                    ->helperText(__('made-cms::cms.resources.settings.website.fields.menu_locations.fields.key.helperText'))
                                    ->required(),

                                TextInput::make('name')
                                    ->label(__('made-cms::cms.resources.settings.website.fields.menu_locations.fields.name.label'))
                                    ->helperText(__('made-cms::cms.resources.settings.website.fields.menu_locations.fields.name.helperText'))
                                    ->required(),

                                Textarea::make('description')
                                    ->label(__('made-cms::cms.resources.settings.website.fields.menu_locations.fields.description.label'))
                                    ->helperText(__('made-cms::cms.resources.settings.website.fields.menu_locations.fields.description.helperText'))
                                    ->nullable(),
                            ])
                            ->addActionLabel(__('made-cms::cms.resources.settings.website.fields.menu_locations.add_action_label'))
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
