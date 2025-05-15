<?php

namespace Made\Cms\Shared\Observers;

use Made\Cms\Shared\Contracts\RouteableContract;

class RouteableObserver
{
    public function saved(RouteableContract $routeable): void
    {
        if ($routeable->route === null && $routeable->isDirty(['parent_id', 'slug'])) {
            $routeable->route()->create([
                'route' => '/' . implode('/', $routeable->urlSchema()),
            ]);
        }

        if ($routeable->route !== null) {
            $routeable->route->update([
                'route' => '/' . implode('/', $routeable->urlSchema()),
            ]);
        }
    }

    public function deleting(RouteableContract $routeable): void
    {
        if ($routeable->route !== null) {
            $routeable->route->delete();
        }
    }
}
