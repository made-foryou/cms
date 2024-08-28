<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Made\Cms\Models\Permission;

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;

uses(RefreshDatabase::class);

it('has a prefixed table name', function () {
    $model = new Permission;

    expect($model->getTable())->toBe('made_cms_permissions');
});

it('can be created', function () {
    $model = Permission::factory()->createOne();

    assertDatabaseCount($model->getTable(), 1);
    assertDatabaseHas($model->getTable(), [
        'name' => $model->name,
    ]);

    expect($model)->toBeInstanceOf(Permission::class);
});

it('can have one or more roles', function () {
    $role = \Made\Cms\Models\Role::factory()->create();

    $permission = \Made\Cms\Models\Permission::factory()->create();

    $permission->roles()->attach($role);

    $model = Permission::query()->first();

    expect($model->roles->count())->toBe(1);

    $newRole = \Made\Cms\Models\Role::factory()->create();

    $permission->roles()->attach($newRole);

    $model->refresh();

    expect($model->roles->count())->toBe(2);

    $names = $model->roles->pluck('name');

    expect($names[0])
        ->toBe($role->name)
        ->and($names[1])
        ->toBe($newRole->name);
});
