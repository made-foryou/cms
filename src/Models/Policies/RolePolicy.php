<?php

namespace Made\Cms\Models\Policies;

use Illuminate\Support\Str;
use Made\Cms\Models\Role;
use Made\Cms\Models\User;

class RolePolicy
{
    use CmsPermissions;

    /**
     * Namespace for the permission names of these methods.
     */
    protected const string NAMESPACE = 'role.';

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
            permission: self::NAMESPACE . Str::snake(__FUNCTION__),
            subject: Role::class,
        );
    }

    /**
     * Determines if the given user has permission to view the target user.
     *
     * @param  Role  $target  The user that is being targeted for viewing.
     * @param  User  $user  The user attempting to view the target user.
     * @return bool True if the user has the necessary permission, false otherwise.
     */
    public function view(User $user, Role $target): bool
    {
        return $this->can(
            user: $user,
            permission: self::NAMESPACE . Str::snake(__FUNCTION__),
            subject: $target::class,
        );
    }

    /**
     * Checks if the given user has permission to create.
     *
     * @param  User  $user  The user for whom the permission is being checked.
     * @return bool True if the user has permission, false otherwise.
     */
    public function create(User $user): bool
    {
        return $this->can(
            user: $user,
            permission: self::NAMESPACE . Str::snake(__FUNCTION__),
            subject: Role::class,
        );
    }

    /**
     * Checks if the given user has permission to update the target user.
     *
     * @param  User  $user  The user for whom the permission is being checked.
     * @param  Role  $target  The user that is the subject of the update.
     * @return bool True if the user has permission, false otherwise.
     */
    public function update(User $user, Role $target): bool
    {
        return $this->can(
            user: $user,
            permission: self::NAMESPACE . Str::snake(__FUNCTION__),
            subject: $target::class,
        );
    }

    /**
     * Checks if the given user has permission to delete the target user.
     *
     * @param  User  $user  The user attempting to perform the delete action.
     * @param  Role  $target  The target user to be deleted.
     * @return bool Returns true if the delete action is authorized, otherwise false.
     */
    public function delete(User $user, Role $target): bool
    {
        return $this->can(
            user: $user,
            permission: self::NAMESPACE . Str::snake(__FUNCTION__),
            subject: $target::class,
        );
    }

    /**
     * Determines if the given user has permission to restore the target user.
     *
     * @param  User  $user  The user attempting to perform the restore action.
     * @param  Role  $target  The target user to be restored.
     * @return bool Returns true if the restore action is authorized, otherwise false.
     */
    public function restore(User $user, Role $target): bool
    {
        return $this->can(
            user: $user,
            permission: self::NAMESPACE . Str::snake(__FUNCTION__),
            subject: $target::class,
        );
    }

    /**
     * Checks if the given user has permission to forcefully delete the target user.
     *
     * @param  User  $user  The user attempting to perform the force delete action.
     * @param  Role  $target  The target user to be forcefully deleted.
     * @return bool Returns true if the force delete action is authorized, otherwise false.
     */
    public function forceDelete(User $user, Role $target): bool
    {
        return $this->can(
            user: $user,
            permission: self::NAMESPACE . Str::snake(__FUNCTION__),
            subject: $target::class,
        );
    }
}
