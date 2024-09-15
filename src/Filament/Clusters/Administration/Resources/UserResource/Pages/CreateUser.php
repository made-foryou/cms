<?php

namespace Made\Cms\Filament\Clusters\Administration\Resources\UserResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Made\Cms\Filament\Clusters\Administration\Resources\UserResource;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
