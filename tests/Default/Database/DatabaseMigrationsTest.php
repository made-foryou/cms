<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\assertDatabaseCount;

uses(RefreshDatabase::class);

it('creates the database tables', function (string $table) {
    $prefix = config('made-cms.database.table_prefix');
    assertDatabaseCount($prefix . $table, 0);
})->with('tables');

dataset('tables', [
    'users',
    'roles',
    'permissions',
    'permission_role',
]);
