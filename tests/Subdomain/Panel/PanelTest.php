<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Made\Cms\Database\Seeders\CmsCoreSeeder;
use Made\Cms\Models\Role;
use Made\Cms\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Laravel\seed;

uses(RefreshDatabase::class);

test('the panel can be accessed', function () {
    $response = get('http://cms.test-project.test');

    $response->assertRedirect('http://cms.test-project.test/login');
});

test('it can be accessed when logged in', function () {
    seed(CmsCoreSeeder::class);

    $role = Role::query()->default()->first();

    /** @var User $user */
    $user = User::factory()->create([
        'role_id' => $role->id,
    ]);

    actingAs($user, 'made');

    get('http://cms.test-project.test')
        ->assertSuccessful();
});
