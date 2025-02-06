<?php

namespace Made\Cms\Analytics\Filament\Resources\VisitResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Made\Cms\Analytics\Filament\Resources\VisitResource;

class CreateVisit extends CreateRecord
{
    protected static string $resource = VisitResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
