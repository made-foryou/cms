<?php

namespace Made\Cms\Page\Models\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Str;
use Made\Cms\Models\Policies\CmsPermissions;
use Made\Cms\Models\User;
use Made\Cms\Page\Models\Page;

class PagePolicy
{
    use CmsPermissions;
    use HandlesAuthorization;

    protected const string NAMESPACE = 'page.';

    public function viewAny(User $user): bool
    {
        return $this->can(
            user: $user,
            permission: self::NAMESPACE . Str::snake(__FUNCTION__),
            subject: Page::class,
        );
    }

    public function view(User $user, Page $page): bool
    {
        return $this->can(
            user: $user,
            permission: self::NAMESPACE . Str::snake(__FUNCTION__),
            subject: Page::class,
        );
    }

    public function create(User $user): bool
    {
        return $this->can(
            user: $user,
            permission: self::NAMESPACE . Str::snake(__FUNCTION__),
            subject: Page::class,
        );
    }

    public function update(User $user, Page $page): bool
    {
        return $this->can(
            user: $user,
            permission: self::NAMESPACE . Str::snake(__FUNCTION__),
            subject: Page::class,
        );
    }

    public function delete(User $user, Page $page): bool
    {
        return $this->can(
            user: $user,
            permission: self::NAMESPACE . Str::snake(__FUNCTION__),
            subject: Page::class,
        );
    }

    public function restore(User $user, Page $page): bool
    {
        return $this->can(
            user: $user,
            permission: self::NAMESPACE . Str::snake(__FUNCTION__),
            subject: Page::class,
        );
    }

    public function forceDelete(User $user, Page $page): bool
    {
        return $this->can(
            user: $user,
            permission: self::NAMESPACE . Str::snake(__FUNCTION__),
            subject: Page::class,
        );
    }
}
