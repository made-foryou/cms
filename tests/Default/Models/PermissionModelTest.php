<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Made\Cms\Models\Permission;
use Made\Cms\Models\Role;

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;

uses(RefreshDatabase::class);

it('has a prefixed table name', function () {
    $model = new Permission;

    expect($model->getTable())->toBe('made_cms_permissions');
});

it('can be created', function () {
    $count = Permission::query()->count();

    $model = Permission::factory()->createOne();

    assertDatabaseCount($model->getTable(), ($count + 1));
    assertDatabaseHas($model->getTable(), [
        'name' => $model->name,
    ]);

    expect($model)->toBeInstanceOf(Permission::class);
});

it('can have one or more roles', function () {
    $role = Role::factory()->create();

    $permission = Permission::factory()->create();

    $permission->roles()->attach($role);

    $permission->refresh();

    expect($permission->roles->count())->toBe(1);

    $newRole = Role::factory()->create();

    $permission->roles()->attach($newRole);

    $permission->refresh()->refresh();

    expect($permission->roles->count())->toBe(2);

    $names = $permission->roles->pluck('name');

    expect($names[0])
        ->toBe($role->name)
        ->and($names[1])
        ->toBe($newRole->name);
});
