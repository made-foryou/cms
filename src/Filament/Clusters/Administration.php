<?php

namespace Made\Cms\Filament\Clusters;

use Filament\Clusters\Cluster;

class Administration extends Cluster
{
    protected static ?string $navigationIcon = 'heroicon-s-users';

    protected static ?string $navigationLabel = 'Gebruikers & Rechten';

    protected static ?string $navigationGroup = 'Administration';
}
