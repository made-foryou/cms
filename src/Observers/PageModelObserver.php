<?php

namespace Made\Cms\Observers;

use Illuminate\Support\Facades\Auth;
use Made\Cms\Models\Page;

class PageModelObserver
{
    public function saving(Page $page): void
    {
        $page->author()->associate(Auth::user());
    }
}
