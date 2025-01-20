<?php

declare(strict_types=1);

namespace Made\Cms\Filament\Resources\PostResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Made\Cms\Filament\Resources\PostResource;
use Made\Cms\News\Models\Post;
use Made\Cms\Shared\Enums\PublishingStatus;

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

    public function getTabs(): array
    {
        $tabs = [
            null => Tab::make(__('made-cms::common.all'))
                ->badge(Post::query()->count()),
        ];

        collect(PublishingStatus::cases())->each(function (PublishingStatus $status) use (&$tabs) {
            $tabs[$status->value] = Tab::make($status->label())
                ->modifyQueryUsing(fn ($query) => $query->where('status', $status->value))
                ->badge(
                    Post::query()
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
