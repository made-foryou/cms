<?php

namespace Made\Cms\Shared\Observers;

use Illuminate\Support\Facades\Auth;
use Made\Cms\Shared\Contracts\DefinesAuthorContract;

class AuthorDefiningObserver
{
    public function saving(DefinesAuthorContract $item): void
    {
        if ($item->author_id === null && Auth::hasUser()) {
            $item->author()->associate(Auth::user());
        }
    }
}
