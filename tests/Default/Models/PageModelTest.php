<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Made\Cms\Models\Meta;
use Made\Cms\Models\Page;
use Made\Cms\Models\User;

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

test('author relationship', function () {
    $user = User::factory()->create();
    $page = Page::factory()->createOneQuietly(['author_id' => $user->id]);

    expect($page->author)->toBeInstanceOf(User::class)
        ->and($page->author->id)->toBe($user->id);
});

test('it generates an author according the logged in user', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $page = new Page;
    $page->name = 'test';
    $page->slug = 'test';
    $page->content = [];
    $page->save();

    $page->refresh();

    expect($page->author->id)->toBe($user->id);

});

test('a page belongs to a parent', function () {
    $parentPage = Page::factory()->createOneQuietly();
    $childPage = Page::factory()->createOneQuietly(['parent_id' => $parentPage->id]);

    expect($childPage->parent)->toBeInstanceOf(Page::class)
        ->and($childPage->parent->id)->toBe($parentPage->id);
});

test('a page without parent has null parent relationship', function () {
    $page = Page::factory()->createOneQuietly(['parent_id' => null]);

    expect($page->parent)->toBeNull();
});

test('it can have children', function () {
    $parentPage = Page::factory()->createOneQuietly();
    $childPage1 = Page::factory()->createOneQuietly(['parent_id' => $parentPage->id]);
    $childPage2 = Page::factory()->createOneQuietly(['parent_id' => $parentPage->id]);

    $children = $parentPage->children;

    expect($children)->toHaveCount(2)
        ->and($children[0]->id)->toBe($childPage1->id)
        ->and($children[1]->id)->toBe($childPage2->id);
});

test('it returns empty collection if no children', function () {
    $page = Page::factory()->createOneQuietly();

    expect($page->children)->toBeEmpty();
});

test('meta relationship', function () {
    $page = Page::factory()->createOneQuietly();
    $meta = Meta::factory()->create(['describable_id' => $page->id, 'describable_type' => Page::class]);

    $result = $page->meta;

    expect($result)->not()->toBeNull();
    expect($result->id)->toBe($meta->id);
});
