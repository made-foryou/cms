<?php

namespace Made\Cms\Language\Filament\Resources\LanguageResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Made\Cms\Language\Filament\Resources\LanguageResource;

class EditLanguage extends EditRecord
{
    protected static string $resource = LanguageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
