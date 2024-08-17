<?php

namespace Made\Cms\Providers;

use Exception;
use Filament\Panel;
use Filament\PanelProvider;

class CmsPanelServiceProvider extends PanelProvider
{
    public const string ID = 'cms-panel';

    /**
     * Sets the ID and path for the given panel.
     *
     * @param  Panel  $panel  The panel to configure.
     * @return Panel The configured panel.
     * @throws Exception
     */
    public function panel(Panel $panel): Panel
    {
        return $panel->id(self::ID)
            ->path(config('made-cms.panel.path'));
    }
}
