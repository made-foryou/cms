<?php

declare(strict_types=1);

namespace Made\Cms\Website\Filament\Resources\MenuItemResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ManageRecords;
use Made\Cms\Models\Settings\WebsiteSetting;
use Made\Cms\Website\Filament\Resources\MenuItemResource;
use Made\Cms\Website\Models\MenuItem;

class ManageMenuItemsPage extends ManageRecords
{
    public static string $resource = MenuItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Onderdeel toevoegen'),
        ];
    }

    public function getTabs(): array
    {
        $tabs = [];

        $locations = (new WebsiteSetting)->menu_locations ?? [];

        collect($locations)->each(
            function (array $location) use (&$tabs) {
                $tabs[$location['key']] = Tab::make($location['name'])
                    ->modifyQueryUsing(fn ($query) => $query->where('location', $location['key']))
                    ->badge(MenuItem::query()->where('location', '=', $location['key'])->count());
            }
        );

        $tabs[null] = Tab::make(__('made-cms::common.all'))
            ->badge(
                MenuItem::all()->count(),
            );

        return $tabs;
    }
}
