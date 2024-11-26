<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Made\Cms\Models\Page;

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;

uses(RefreshDatabase::class);

test('it has a prefixed table name', function () {
    $model = new Page;

    expect($model->getTable())->toBe('made_cms_pages');
});

test('page model can be created', function () {
    $model = Page::factory()->createOneQuietly();

    assertDatabaseCount($model->getTable(), 1);
    assertDatabaseHas($model->getTable(), [
        'name' => $model->name,
    ]);

    expect($model)->toBeInstanceOf(Page::class);
});
