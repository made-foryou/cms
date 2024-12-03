<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\assertDatabaseCount;

uses(RefreshDatabase::class);

it('creates the database tables', function (string $table, int $count) {
    $prefix = config('made-cms.database.table_prefix');
    assertDatabaseCount($prefix . $table, $count);
})->with('tables');

dataset('tables', [
    'users' => [
        'users',
        0,
    ],
    'roles' => [
        'roles',
        1,
    ],
    'permissions' => [
        'permissions',
        43,
    ],
    'permission_role' => [
        'permission_role',
        43,
    ],
    'pages' => [
        'pages',
        0,
    ],
    'meta' => [
        'meta',
        0,
    ],
    'languages' => [
        'languages',
        0,
    ],
]);
