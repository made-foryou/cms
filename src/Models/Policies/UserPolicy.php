<?php

namespace Made\Cms\Models\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Made\Cms\Models\User;

class UserPolicy
{
    use CmsPermissions;
    use HandlesAuthorization;

    /**
     * Checks whether the specified user has access to the panel.
     *
     * @param  User  $user  The user for which to check access.
     * @return bool True if the user has access to the panel, false otherwise.
     */
    public function accessPanel(User $user): bool
    {
        return $this->can($user, __FUNCTION__);
    }
}
