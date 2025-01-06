<?php

namespace Made\Cms\Filament\Resources\PostResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Made\Cms\Filament\Resources\PostResource;

class CreatePost extends CreateRecord
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
