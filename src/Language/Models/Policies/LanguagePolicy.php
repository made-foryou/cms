<?php

namespace Made\Cms\Language\Models\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Str;
use Made\Cms\Language\Models\Language;
use Made\Cms\Models\Policies\CmsPermissions;
use Made\Cms\Models\User;

class LanguagePolicy
{
    use CmsPermissions;
    use HandlesAuthorization;

    protected const string NAMESPACE = 'language.';

    public function viewAny(User $user): bool
    {
        return $this->can(
            user: $user,
            permission: self::NAMESPACE . Str::snake(__FUNCTION__),
            subject: Language::class,
        );
    }

    public function view(User $user, Language $language): bool
    {
        return $this->can(
            user: $user,
            permission: self::NAMESPACE . Str::snake(__FUNCTION__),
            subject: Language::class,
        );
    }

    public function create(User $user): bool
    {
        return $this->can(
            user: $user,
            permission: self::NAMESPACE . Str::snake(__FUNCTION__),
            subject: Language::class,
        );
    }

    public function update(User $user, Language $language): bool
    {
        return $this->can(
            user: $user,
            permission: self::NAMESPACE . Str::snake(__FUNCTION__),
            subject: Language::class,
        );
    }

    public function delete(User $user, Language $language): bool
    {
        return $this->can(
            user: $user,
            permission: self::NAMESPACE . Str::snake(__FUNCTION__),
            subject: Language::class,
        );
    }

    public function restore(User $user, Language $language): bool
    {
        return $this->can(
            user: $user,
            permission: self::NAMESPACE . Str::snake(__FUNCTION__),
            subject: Language::class,
        );
    }

    public function forceDelete(User $user, Language $language): bool
    {
        return $this->can(
            user: $user,
            permission: self::NAMESPACE . Str::snake(__FUNCTION__),
            subject: Language::class,
        );
    }
}
