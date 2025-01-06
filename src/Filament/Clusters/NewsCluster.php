<?php

declare(strict_types=1);

namespace Made\Cms\Filament\Clusters;

use Filament\Clusters\Cluster;

class NewsCluster extends Cluster
{
    protected static ?string $navigationIcon = 'heroicon-s-newspaper';

    protected static ?string $navigationGroup = 'Modules';

    /**
     * Retrieves the navigation label for the news cluster.
     *
     * @return string The localized navigation label for the news cluster.
     */
    public static function getNavigationLabel(): string
    {
        return __('made-cms::cms.clusters.news.label');
    }
}
