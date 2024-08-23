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
