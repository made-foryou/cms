<?php

namespace Made\Cms\Providers;

use Exception;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
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
            ->discoverResources(in: __DIR__ . '/../Filament/Resources', for: 'Made\\Cms\\Filament\\Resources')
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverClusters(in: __DIR__ . '/../Filament/Clusters', for: 'Made\\Cms\\Filament\\Clusters')
            ->discoverClusters(in: app_path('Filament/Clusters'), for: 'App\\Filament\\Clusters')
            ->discoverPages(in: __DIR__ . '/../Filament/Pages', for: 'Made\\Cms\\Filament\\Pages')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
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
            ->maxContentWidth(MaxWidth::Full);
    }
}
