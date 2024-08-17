<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Made\Cms\Models\User;

use Made\Cms\Providers\CmsPanelServiceProvider;

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;

uses(RefreshDatabase::class);

test('it has a prefixed table name', function () {
    $model = new User;

    expect($model->getTable())->toBe('made_cms_users');
});

test('user model can be created', function () {
    $model = User::factory()->createOne();

    assertDatabaseCount($model->getTable(), 1);
    assertDatabaseHas($model->getTable(), [
        'email' => $model->email,
    ]);

    expect($model)->toBeInstanceOf(User::class);
});

test('it can access the cms panel', function () {
    $model = User::factory()->createOne();

    expect(
        $model->canAccessPanel(
            filament()->getPanel(CmsPanelServiceProvider::ID)
        )
    )->toBeTrue();
});
