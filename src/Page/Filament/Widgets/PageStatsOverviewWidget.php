<?php

namespace Made\Cms\Page\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Made\Cms\Page\Models\Page;

class PageStatsOverviewWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            StatsOverviewWidget\Stat::make('Aantal gepuliceerde pagina\'s', Page::query()->published()->count()),
            StatsOverviewWidget\Stat::make('Aantal pagina\'s in draft', Page::query()->draft()->count()),
            StatsOverviewWidget\Stat::make('Aantal pagina\'s in totaal', Page::query()->count()),
        ];
    }
}
