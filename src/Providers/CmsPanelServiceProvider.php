<?php

namespace Made\Cms\Providers;

use Exception;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\MaxWidth;
use Filament\Widgets\AccountWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Made\Cms\Analytics\Filament\Pages\AnalyticsSettingsPage;
use Made\Cms\Analytics\Filament\Resources\VisitResource;
use Made\Cms\Filament\Resources\RoleResource;
use Made\Cms\Filament\Resources\UserResource;
use Made\Cms\Filament\Widgets\MadeInfoWidget;
use Made\Cms\Information\Filament\Pages\InformationSettingsPage;
use Made\Cms\Language\Filament\Resources\LanguageResource;
use Made\Cms\News\Filament\Resources\PostResource;
use Made\Cms\Page\Filament\Resources\PageResource;
use Made\Cms\Page\Filament\Widgets\PageStatsOverviewWidget;
use Made\Cms\Website\Filament\Pages\WebsiteSettingsPage;
use Made\Cms\Website\Filament\Resources\MenuItemResource;
use Pboivin\FilamentPeek\FilamentPeekPlugin;

class CmsPanelServiceProvider extends PanelProvider
{
    public const string ID = 'cms-panel';

    /**
     * Sets the ID and path for the given panel.
     *
     * @param  Panel  $panel  The panel to configure.
     * @return Panel The configured panel.
     *
     * @throws Exception
     */
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id(self::ID)
            ->path(config('made-cms.panel.path', ''))
            ->domain(config('made-cms.panel.domain'))
            ->authGuard('made')
            ->brandName('Made CMS')
            ->colors([
                'primary' => Color::Blue,
            ])
            ->resources(
                $this->getResources(),
            )
            ->pages(
                $this->getPages(),
            )
            ->widgets(
                $this->getWidgets(),
            )
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->login()
            ->default(config('made-cms.panel.default') ?? true)
            ->maxContentWidth(MaxWidth::Full)
            ->navigationGroups($this->getNavigation())
            ->plugins($this->getPlugins());
    }

    protected function getResources(): array
    {
        return [
            LanguageResource::class,
            PageResource::class,
            PostResource::class,
            RoleResource::class,
            UserResource::class,
            VisitResource::class,
            MenuItemResource::class,

            ...config('made-cms.panel.resources', []),
        ];
    }

    protected function getPages(): array
    {
        return [
            Dashboard::class,

            WebsiteSettingsPage::class,
            AnalyticsSettingsPage::class,
            InformationSettingsPage::class,
            
            ...config('made-cms.panel.pages', []),
        ];
    }

    protected function getWidgets(): array
    {
        return [
            AccountWidget::class,
            MadeInfoWidget::class,
            PageStatsOverviewWidget::class,
            ...config('made-cms.panel.widgets', []),
        ];
    }

    protected function getPlugins(): array
    {
        return [
            FilamentPeekPlugin::make(),
        ];
    }

    protected function getNavigation(): array
    {
        return [
            NavigationGroup::make()
                ->label(fn (): string => __('made-cms::cms.navigation_groups.website'))
                ->icon('heroicon-o-globe-alt'),

            NavigationGroup::make()
                ->label(fn (): string => __('made-cms::cms.navigation_groups.news'))
                ->icon('heroicon-o-newspaper'),

            NavigationGroup::make()
                ->label(fn (): string => __('made-cms::cms.navigation_groups.analytics'))
                ->icon('heroicon-o-chart-bar-square'),

            NavigationGroup::make()
                ->label(fn (): string => __('made-cms::cms.navigation_groups.security'))
                ->icon('heroicon-o-shield-check'),

            NavigationGroup::make()
                ->label(fn (): string => __('made-cms::cms.navigation_groups.company'))
                ->icon('heroicon-o-information-circle'),
        ];
    }
}
