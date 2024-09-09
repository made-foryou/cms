<?php

use Made\Cms\Models\User;

describe('Panel configuration', function () {
    test('it has a panel path setting', function () {
        expect(config('made-cms.panel.path'))
            ->toBe('made');
    });

    test('it has a panel resources setting', function () {
        expect(config('made-cms.panel.resources.user.group'))
            ->toBeNull();
    });
});

describe('Database configuration', function () {
    test('it has a table prefix setting', function () {
        expect(config('made-cms.database.table_prefix'))
            ->toBe('made_cms_');
    });
});

describe('Auth guard addition', function () {
    test('it registers a new auth guard', function () {
        expect(config('auth.guards.made.driver'))
            ->toBe('session')
            ->and(config('auth.guards.made.provider'))
            ->toBe('made');
    });

    test('it registers a new auth provider', function () {
        expect(config('auth.providers.made.driver'))
            ->toBe('eloquent')
            ->and(config('auth.providers.made.model'))
            ->toBe(User::class);
    });
});
