<?php

namespace Made\Cms\Filament\Clusters\Administration\Resources\UserResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Made\Cms\Filament\Clusters\Administration\Resources\UserResource;
use Made\Cms\Models\Role;
use Made\Cms\Models\User;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        $tabs = [
            null => Tab::make(__('made-cms::common.all'))
                ->badge(User::query()->count()),
        ];

        $roles = Role::all();

        $roles->each(function (Role $role) use (&$tabs) {
            $tabs[$role->id] = Tab::make($role->name)->modifyQueryUsing(
                fn ($query) => $query->where('role_id', $role->id),
            )->badge(
                User::query()
                    ->where('role_id', $role->id)
                    ->count()
            );
        });

        if (count($tabs) <= 1) {
            return [];
        }

        return $tabs;
    }
}
