<?php

namespace Made\Cms\Providers;

use Exception;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Made\Cms\Filament\Pages\WebsiteSettingsPage;
use Made\Cms\Filament\Resources\RoleResource;
use Made\Cms\Filament\Resources\UserResource;
use Made\Cms\Language\Filament\Resources\LanguageResource;
use Made\Cms\News\Filament\Resources\PostResource;
use Made\Cms\Page\Filament\Resources\PageResource;

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
            ->navigationGroups([
                NavigationGroup::make()
                    ->label(fn (): string => __('made-cms::cms.navigation_groups.website'))
                    ->icon('heroicon-o-globe-alt'),

                NavigationGroup::make()
                    ->label(fn (): string => __('made-cms::cms.navigation_groups.news'))
                    ->icon('heroicon-o-newspaper'),

                NavigationGroup::make()
                    ->label(fn (): string => __('made-cms::cms.navigation_groups.security'))
                    ->icon('heroicon-o-shield-check'),
            ]);
    }

    protected function getResources(): array
    {
        return [
            LanguageResource::class,
            PageResource::class,
            PostResource::class,
            RoleResource::class,
            UserResource::class,
            ...config('made-cms.panel.resources', []),
        ];
    }

    protected function getPages(): array
    {
        return [
            WebsiteSettingsPage::class,
            ...config('made-cms.panel.pages', []),
        ];
    }
}
