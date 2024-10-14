<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Made\Cms\Models\Permission;
use Made\Cms\Models\Role;
use Made\Cms\Models\User;

use function Pest\Laravel\assertDatabaseHas;

uses(RefreshDatabase::class);

it('provides the basic setup for the cms.', function () {
    $name = fake()->name;
    $email = fake()->email;

    $this->artisan('made-cms:setup')
        ->expectsQuestion('What is the persons name?', $name)
        ->expectsQuestion('What is the persons mail address?', $email)
        ->expectsQuestion('What password will it be using?', fake()->word)
        ->assertSuccessful();

    assertDatabaseHas((new Role)->getTable(), [
        'name' => 'Administrator',
        'is_default' => true,
    ]);

    /** @var Role $role */
    $role = Role::query()->default()->first();

    assertDatabaseHas((new User)->getTable(), [
        'name' => $name,
        'email' => $email,
        'role_id' => $role->id,
    ]);

    expect((Permission::query()->count()))->toBeGreaterThan(0);
});
