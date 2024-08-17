<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Made\Cms\Models\User;

use function Pest\Laravel\assertDatabaseHas;

uses(RefreshDatabase::class);

test('it creates a cms user', function () {
    $name = fake()->name;
    $email = fake()->email;

    $this->artisan('made:user')
        ->expectsQuestion('What is the persons name?', $name)
        ->expectsQuestion('What is the persons mail address?', $email)
        ->expectsQuestion('What password will it be using?', fake()->word)
        ->assertSuccessful();

    assertDatabaseHas((new User)->getTable(), [
        'name' => $name,
        'email' => $email,
    ]);
});
