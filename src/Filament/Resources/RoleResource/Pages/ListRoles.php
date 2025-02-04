<?php

namespace Made\Cms\Filament\Resources\RoleResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Made\Cms\Filament\Resources\RoleResource;

class ListRoles extends ListRecords
{
    protected static string $resource = RoleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getBreadcrumb(): ?string
    {
        return __('made-cms::cms.resources.common.overview');
    }

    public static function getNavigationLabel(): string
    {
        return __('made-cms::cms.resources.common.overview');
    }
}
