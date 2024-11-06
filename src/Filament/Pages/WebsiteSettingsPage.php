<?php

namespace Made\Cms\Filament\Pages;

use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Made\Cms\Models\Settings\WebsiteSetting;

class WebsiteSettingsPage extends SettingsPage
{
    /**
     * The settings model for saving and retrieving the data from
     * the database.
     */
    protected static string $settings = WebsiteSetting::class;

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
                Toggle::make('online')
                    ->label(__('made-cms::cms.resources.settings.website.online.label'))
                    ->helperText(__('made-cms::cms.resources.settings.website.online.description')),
            ]);
    }
}
