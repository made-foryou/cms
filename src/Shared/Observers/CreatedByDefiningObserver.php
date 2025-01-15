<?php

namespace Made\Cms\Shared\Observers;

use Illuminate\Support\Facades\Auth;
use Made\Cms\Shared\Contracts\DefinesCreatedByContract;

class CreatedByDefiningObserver
{
    public function saving(DefinesCreatedByContract $item): void
    {
        if ($item->created_by === null && Auth::hasUser()) {
            $item->createdBy()->associate(Auth::user());
        }
    }
}
