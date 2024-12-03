<?php

namespace Made\Cms\Models\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Str;
use Made\Cms\Models\Meta;
use Made\Cms\Models\User;

class MetaPolicy
{
    use CmsPermissions;
    use HandlesAuthorization;

    protected const string NAMESPACE = 'meta.';

    public function viewAny(User $user): bool
    {
        return $this->can(
            user: $user,
            permission: self::NAMESPACE . Str::snake(__FUNCTION__),
            subject: Meta::class,
        );
    }

    public function view(User $user, Meta $meta): bool
    {
        return $this->can(
            user: $user,
            permission: self::NAMESPACE . Str::snake(__FUNCTION__),
            subject: Meta::class,
        );
    }

    public function create(User $user): bool
    {
        return $this->can(
            user: $user,
            permission: self::NAMESPACE . Str::snake(__FUNCTION__),
            subject: Meta::class,
        );
    }

    public function update(User $user, Meta $meta): bool
    {
        return $this->can(
            user: $user,
            permission: self::NAMESPACE . Str::snake(__FUNCTION__),
            subject: Meta::class,
        );
    }

    public function delete(User $user, Meta $meta): bool
    {
        return $this->can(
            user: $user,
            permission: self::NAMESPACE . Str::snake(__FUNCTION__),
            subject: Meta::class,
        );
    }

    public function restore(User $user, Meta $meta): bool
    {
        return $this->can(
            user: $user,
            permission: self::NAMESPACE . Str::snake(__FUNCTION__),
            subject: Meta::class,
        );
    }

    public function forceDelete(User $user, Meta $meta): bool
    {
        return $this->can(
            user: $user,
            permission: self::NAMESPACE . Str::snake(__FUNCTION__),
            subject: Meta::class,
        );
    }
}
