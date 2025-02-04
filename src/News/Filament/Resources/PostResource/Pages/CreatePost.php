<?php

namespace Made\Cms\News\Filament\Resources\PostResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Made\Cms\News\Filament\Resources\PostResource;

class CreatePost extends CreateRecord
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
