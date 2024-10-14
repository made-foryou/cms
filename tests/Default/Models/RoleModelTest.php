<?php

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Made\Cms\Models\Permission;
use Made\Cms\Models\Role;
use Made\Cms\Models\User;

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;

uses(RefreshDatabase::class);

it('has a prefixed table name', function () {
    $model = new Role;

    expect($model->getTable())->toBe('made_cms_roles');
});

it('can be created', function () {
    $model = Role::factory()->createOne();

    assertDatabaseCount($model->getTable(), 2);
    assertDatabaseHas($model->getTable(), [
        'name' => $model->name,
    ]);

    expect($model)->toBeInstanceOf(Role::class);
});

it('can be made default', function () {
    /** @var Collection<Role> $roles */
    $roles = Role::factory()->count(5)->create();

    /** @var Role $role */
    $role = $roles->random(1)->first();

    $role->makeDefault();

    assertDatabaseHas($role->getTable(), [
        'name' => $role->name,
        'is_default' => '1',
    ]);

    expect(Role::query()->where('is_default', '1')->count())
        ->toBe(1);
});

it('knows if it is default', function () {
    /** @var Role $role */
    $role = Role::factory()->default()->createOne();

    expect($role->is_default)->toBe(true);

    $role = Role::factory()->createOne();

    $role->refresh();

    expect($role->is_default)->toBe(false);
});

it('can have users', function () {
    $role = Role::factory()->createOne();

    $user = User::factory()->create([
        'role_id' => $role->id,
    ]);

    expect($role->users->count())->toBe(1);
});

it('can have permissions', function () {
    $role = Role::factory()
        ->has(Permission::factory()->count(10))
        ->createOne();

    expect($role->permissions->count())->toBe(10);
});
