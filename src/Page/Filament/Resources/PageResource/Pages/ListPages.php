<?php

namespace Made\Cms\Page\Filament\Resources\PageResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Made\Cms\Page\Filament\Resources\PageResource;
use Made\Cms\Page\Models\Page;
use Made\Cms\Shared\Enums\PublishingStatus;

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

        collect(PublishingStatus::cases())->each(function (PublishingStatus $status) use (&$tabs) {
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
