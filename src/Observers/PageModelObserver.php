<?php

namespace Made\Cms\Observers;

use Illuminate\Support\Facades\Auth;
use Made\Cms\Models\Page;

class PageModelObserver
{
    public function saving(Page $page): void
    {
        if ($page->author_id === null && Auth::hasUser()) {
            $page->author()->associate(Auth::user());
        }
    }

    public function saved(Page $page): void
    {
        if ($page->route === null && $page->isDirty(['parent_id', 'slug'])) {
            $page->route()->create([
                'route' => '/' . implode('/', $page->urlSchema()),
            ]);
        }

        if ($page->route !== null) {
            $page->route->update([
                'route' => '/' . implode('/', $page->urlSchema()),
            ]);
        }
    }

    public function deleting(Page $page): void
    {
        if ($page->route !== null) {
            $page->route->delete();
        }
    }
}
