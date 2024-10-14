<?php

namespace Made\Cms\Filament\Clusters\Administration\Resources\RoleResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Made\Cms\Filament\Clusters\Administration\Resources\RoleResource;

class CreateRole extends CreateRecord
{
    protected static string $resource = RoleResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
