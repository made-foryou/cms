<?php

declare(strict_types=1);

namespace Made\Cms\News\Filament\Pages;

use Filament\Forms\Components;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Illuminate\Contracts\Support\Htmlable;
use Made\Cms\Facades\Made;
use Made\Cms\News\Models\Settings\NewsSettings;

class NewsSettingsPage extends SettingsPage
{
    use \Made\Cms\Shared\Models\MergesConfigFields;

    /**
     * The sort order for showing the navigation items.
     */
    protected static ?int $navigationSort = 10;

    public function form(Form $form): Form
    {
        return $form
            ->schema(array_merge([
                
                Components\Section::make(
                    __('made-cms::cms.resources.settings.news.sections.general.title')
                )
                    ->description(
                        __('made-cms::cms.resources.settings.news.sections.general.description')
                    )
                    ->aside()
                    ->columnSpan(4)
                    ->schema([

                        Components\Select::make('news_page')
                            ->label(__('made-cms::cms.resources.settings.news.fields.news_page.label'))
                            ->helperText(__('made-cms::cms.resources.settings.news.fields.news_page.helperText'))
                            ->options(Made::madeLinkOptions([Made::LINK_TYPE_PAGES])),
                                
                    ]),

            ], ...$this->configFields()))
            ->columns(5);
    }


    /**
     * Retrieves the navigation label for the website settings.
     *
     * @return string The navigation label.
     */
    public static function getNavigationLabel(): string
    {
        return __('made-cms::cms.resources.settings.news.label');
    }

    /**
     * Retrieves and returns the navigation group string for website management.
     *
     * @return string The navigation group string.
     */
    public static function getNavigationGroup(): string
    {
        return __('made-cms::cms.navigation_groups.news');
    }

    public static function getSettings(): string
    {
        return config('made-cms.settings.news_model') ?? NewsSettings::class;
    }

    public function getTitle(): string|Htmlable
    {
        return __('made-cms::cms.resources.settings.news.title');
    }
}