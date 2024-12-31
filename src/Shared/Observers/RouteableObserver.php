<?php

namespace Made\Cms\Shared\Observers;

use Made\Cms\Shared\Contracts\RouteableContract;

class RouteableObserver
{
    public function saved(RouteableContract $item): void
    {
        if ($item->route === null && $item->isDirty(['parent_id', 'slug'])) {
            $item->route()->create([
                'route' => '/' . implode('/', $item->urlSchema()),
            ]);
        }

        if ($item->route !== null) {
            $item->route->update([
                'route' => '/' . implode('/', $item->urlSchema()),
            ]);
        }
    }

    public function deleting(RouteableContract $page): void
    {
        if ($page->route !== null) {
            $page->route->delete();
        }
    }
}
