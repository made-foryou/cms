<?php

namespace Made\Cms\Language\Filament\Resources\LanguageResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Made\Cms\Language\Filament\Resources\LanguageResource;

class CreateLanguage extends CreateRecord
{
    protected static string $resource = LanguageResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
