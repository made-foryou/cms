<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('the panel can be accessed', function () {
    $this->get('/' . config('made-cms.panel.path'))
        ->assertSuccessful();
});
