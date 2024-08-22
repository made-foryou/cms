<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

test('the panel can be accessed', function () {
    $this->get('/' . config('made-cms.panel.path'))
        ->assertRedirect('/'. config('made-cms.panel.path') .'/login');
});

test('it can be accessed when logged in', function () {
    $user = \Made\Cms\Models\User::factory()->create();

    actingAs($user, 'made');

    $this->get('/' . config('made-cms.panel.path'))
        ->assertSuccessful();
});
