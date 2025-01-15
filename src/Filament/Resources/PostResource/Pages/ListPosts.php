<?php

namespace Made\Cms\Filament\Resources\PostResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Made\Cms\Filament\Resources\PostResource;

class ListPosts extends ListRecords
{
    protected static string $resource = PostResource::class;

    public static ?string $title = 'Overzicht';

    public static ?string $breadcrumb = 'Overzicht';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
