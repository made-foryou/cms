<?php

namespace Made\Cms\Models\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Made\Cms\Models\User;

class UserPolicy
{
    use HandlesAuthorization;

    public function accessPanel(User $user): bool
    {
        $permissions = $user->role->permissions()->pluck('key');

        return $permissions->contains('accessPanel');
    }
}
