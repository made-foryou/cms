<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Made\Cms\Database\Seeders\CmsCoreSeeder;
use Made\Cms\Models\Role;
use Made\Cms\Models\User;
use Made\Cms\Providers\CmsPanelServiceProvider;

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\seed;

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
    )->toBeFalse();

    seed(CmsCoreSeeder::class);

    $trueUser = User::factory()->create([
        'role_id' => Role::query()->default()->first()->id,
    ]);

    expect(
        $trueUser->canAccessPanel(
            filament()->getPanel(CmsPanelServiceProvider::ID)
        )
    )->toBeTrue();
});
