<?php

namespace Made\Cms\Models\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Str;
use Made\Cms\Models\User;

class UserPolicy
{
    use CmsPermissions;
    use HandlesAuthorization;

    protected const string NAMESPACE = 'user.';

    /**
     * Checks whether the specified user has access to the panel.
     *
     * @param  User  $user  The user for which to check access.
     * @return bool True if the user has access to the panel, false otherwise.
     */
    public function accessPanel(User $user): bool
    {
        return $this->can(
            user: $user,
            permission: self::NAMESPACE . Str::snake(__FUNCTION__)
        );
    }

    /**
     * Determines if the user has permission to view any resource.
     *
     * @param  User  $user  The user object.
     * @return bool True if the user has the permission, false otherwise.
     */
    public function viewAny(User $user): bool
    {
        return $this->can(
            user: $user,
            permission: self::NAMESPACE . Str::snake(__FUNCTION__)
        );
    }
}
