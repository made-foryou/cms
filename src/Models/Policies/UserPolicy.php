<?php

namespace Made\Cms\Models\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Made\Cms\Models\User;

class UserPolicy
{
    use HandlesAuthorization;

    public function accessPanel(User $user, User $subject): bool
    {
        return $user->role->permissions()
            ->is($subject::class, 'accessPanel')
            ->get()
            ->isNotEmpty();
    }
}
