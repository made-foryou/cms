<?php

namespace Made\Cms\Filament\Resources\PageResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Made\Cms\Enums\PageStatus;
use Made\Cms\Filament\Resources\PageResource;
use Made\Cms\Models\Page;

class ListPages extends ListRecords
{
    protected static string $resource = PageResource::class;

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
                ->badge(Page::query()->count()),
        ];

        collect(PageStatus::cases())->each(function (PageStatus $status) use (&$tabs) {
            $tabs[$status->value] = Tab::make($status->label())
                ->modifyQueryUsing(fn ($query) => $query->where('status', $status->value))
                ->badge(
                    Page::query()
                        ->where('status', $status->value)
                        ->count()
                );
        });

        if (count($tabs) <= 1) {
            return [];
        }

        return $tabs;
    }
}
