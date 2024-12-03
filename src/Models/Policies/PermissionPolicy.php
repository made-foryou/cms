<?php

namespace Made\Cms\Models\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Str;
use Made\Cms\Models\Permission;
use Made\Cms\Models\User;

class PermissionPolicy
{
    use CmsPermissions;
    use HandlesAuthorization;

    protected const string NAMESPACE = 'permission.';

    public function viewAny(User $user): bool
    {
        return $this->can(
            user: $user,
            permission: self::NAMESPACE . Str::snake(__FUNCTION__),
            subject: Permission::class,
        );
    }

    public function view(User $user, Permission $permission): bool
    {
        return $this->can(
            user: $user,
            permission: self::NAMESPACE . Str::snake(__FUNCTION__),
            subject: Permission::class,
        );
    }

    public function create(User $user): bool
    {
        return $this->can(
            user: $user,
            permission: self::NAMESPACE . Str::snake(__FUNCTION__),
            subject: Permission::class,
        );
    }

    public function update(User $user, Permission $permission): bool
    {
        return $this->can(
            user: $user,
            permission: self::NAMESPACE . Str::snake(__FUNCTION__),
            subject: Permission::class,
        );
    }

    public function delete(User $user, Permission $permission): bool
    {
        return $this->can(
            user: $user,
            permission: self::NAMESPACE . Str::snake(__FUNCTION__),
            subject: Permission::class,
        );
    }

    public function restore(User $user, Permission $permission): bool
    {
        return $this->can(
            user: $user,
            permission: self::NAMESPACE . Str::snake(__FUNCTION__),
            subject: Permission::class,
        );
    }

    public function forceDelete(User $user, Permission $permission): bool
    {
        return $this->can(
            user: $user,
            permission: self::NAMESPACE . Str::snake(__FUNCTION__),
            subject: Permission::class,
        );
    }
}
