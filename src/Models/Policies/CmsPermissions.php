<?php

namespace Made\Cms\Models\Policies;

use Made\Cms\Models\User;

trait CmsPermissions
{
    /**
     * Determines if a user has a specific permission.
     *
     * @param  User  $user  The user object for which to check the permission.
     * @param  string  $permission  The permission string to check.
     * @param  string|null  $subject  The subject string for which to check the permission. Defaults to null.
     * @return bool Returns true if the user has the specified permission, false otherwise.
     */
    protected function can(
        User $user,
        string $permission,
        ?string $subject = null
    ): bool {
        dump($permission);

        return $user->role->permissions()
            ->is(($subject === null ? $user::class : $subject), $permission)
            ->get()
            ->isNotEmpty();
    }
}
