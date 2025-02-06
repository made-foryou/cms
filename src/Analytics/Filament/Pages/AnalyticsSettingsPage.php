<?php

declare(strict_types=1);

namespace Made\Cms\Analytics\Filament\Pages;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Illuminate\Contracts\Support\Htmlable;
use Made\Cms\Analytics\Enums\VisitSavingStrategy;
use Made\Cms\Analytics\Models\Settings\AnalyticsSettings;

class AnalyticsSettingsPage extends SettingsPage
{
    /**
     * @var string The settings model which saves and retrieves data from the database.
     */
    protected static string $settings = AnalyticsSettings::class;

    /**
     * @var int|null Sorting number which represents the order within the navigation group.
     */
    protected static ?int $navigationSort = 10;

    /**
     * Configures and returns the provided form instance with a specific schema.
     *
     * @param  Form  $form  The form instance to be configured.
     * @return Form The configured form instance.
     */
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('made-cms::cms.resources.settings.analytics.sections.visits.heading'))
                    ->description(__('made-cms::cms.resources.settings.analytics.sections.visits.description'))
                    ->aside()
                    ->schema([
                        TagsInput::make('ip_blacklist')
                            ->label(__('made-cms::cms.resources.settings.analytics.fields.ip_blacklist.label'))
                            ->helperText(__('made-cms::cms.resources.settings.analytics.fields.ip_blacklist.helperText'))
                            ->placeholder(__('made-cms::cms.resources.settings.analytics.fields.ip_blacklist.placeholder')),

                        Select::make('saving_strategy')
                            ->label(__('made-cms::cms.resources.settings.analytics.fields.saving_strategy.label'))
                            ->helperText(__('made-cms::cms.resources.settings.analytics.fields.saving_strategy.helperText'))
                            ->options(VisitSavingStrategy::options()),
                    ])
                    ->columnSpan([
                        'xl' => 4,
                        '2xl' => 3,
                    ]),
            ])
            ->columns(4);
    }

    /**
     * Retrieves the navigation label for the resource.
     *
     * @return string The navigation label.
     */
    public static function getNavigationLabel(): string
    {
        return __('made-cms::cms.resources.settings.analytics.label');
    }

    /**
     * Retrieves the plural label for the resource.
     *
     * @return string|null The plural label if defined, or null otherwise.
     */
    public static function getPluralLabel(): ?string
    {
        return __('made-cms::cms.resources.settings.analytics.label');
    }

    public function getTitle(): string | Htmlable
    {
        return __('made-cms::cms.resources.settings.analytics.label');
    }

    /**
     * Retrieves the navigation group for the resource.
     *
     * @return string|null The navigation group if defined, or null otherwise.
     */
    public static function getNavigationGroup(): ?string
    {
        return __('made-cms::cms.navigation_groups.analytics');
    }
}
