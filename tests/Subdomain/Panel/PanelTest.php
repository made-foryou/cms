<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

test('the panel can be accessed', function () {
    $response = $this->get('http://cms.test-project.test');

    $response->assertRedirect('http://cms.test-project.test/login');
});

test('it can be accessed when logged in', function () {
    $user = \Made\Cms\Models\User::factory()->create();

    actingAs($user, 'made');

    $this->get('http://cms.test-project.test')
        ->assertSuccessful();
});
