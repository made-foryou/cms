<?php

namespace Made\Cms\Providers;

use Exception;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
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
            ->path(config('made-cms.panel.path'))
            ->authGuard('made')
            ->brandName('Made CMS')
            ->colors([
                'primary' => Color::Blue,
            ])
            ->pages([
                Dashboard::class,
            ])
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
            ->login();
    }
}
