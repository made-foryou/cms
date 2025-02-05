<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Made\Cms\Database\Seeders\CmsCoreSeeder;
use Made\Cms\Helpers\Permissions;
use Made\Cms\Models\Permission;
use Made\Cms\Shared\Exceptions\MissingDefaultRoleException;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\seed;

uses(RefreshDatabase::class);

it('cannot create permissions while missing a default role', function () {
    \Made\Cms\Models\Role::query()->truncate();

    Permissions::create(
        fake()->word(),
        fake()->word(),
    );
})->throws(MissingDefaultRoleException::class);

it('can generate permissions while having a default role', function () {
    seed(CmsCoreSeeder::class);

    $key = fake()->word();
    $subject = fake()->word();

    Permissions::create(
        $key,
        $subject,
    );

    assertDatabaseHas((new Permission)->getTable(), [
        'key' => $key,
        'subject' => $subject,
    ]);
});
