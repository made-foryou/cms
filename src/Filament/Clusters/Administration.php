<?php

namespace Made\Cms\Filament\Clusters;

use Filament\Clusters\Cluster;

class Administration extends Cluster
{
    protected static ?string $navigationIcon = 'heroicon-s-lock-open';

    protected static ?string $navigationLabel = 'Gebruikersbeheer';

    protected static ?string $navigationGroup = 'Administratie';

    protected static ?string $clusterBreadcrumb = 'Administratie';
}
