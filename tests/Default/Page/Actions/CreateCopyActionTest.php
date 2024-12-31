<?php

namespace Made\Cms\Tests\Page\Actions;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Made\Cms\Language\Models\Language;
use Made\Cms\Models\Meta;
use Made\Cms\Models\Page;
use Made\Cms\Models\User;
use Made\Cms\Page\Actions\CreateCopyAction;
use Made\Cms\Shared\Enums\PublishingStatus;

use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

test('copy page with meta data', function () {

    /** @var Page $originalPage */
    $originalPage = Page::factory()->create([
        'status' => PublishingStatus::Published,
    ]);

    Meta::factory()
        ->create([
            'describable_type' => Page::class,
            'describable_id' => $originalPage->id,
        ]);

    actingAs($user = User::factory()->create());

    $copyPage = (new CreateCopyAction)->handle($originalPage);

    expect($copyPage)->name->toBe($originalPage->name)
        ->slug->toBe($originalPage->slug)
        ->status->toBe(PublishingStatus::Draft)
        ->content->toBe($originalPage->content)
        ->meta->title->toBe($originalPage->meta->title)
        ->meta->description->toBe($originalPage->meta->description);
});

test('copy page without meta data', function () {
    /** @var Page $originalPage */
    $originalPage = Page::factory()->create(['status' => PublishingStatus::Published]);

    actingAs($user = User::factory()->create());

    $copyPage = (new CreateCopyAction)->handle($originalPage);

    expect($copyPage)->status->toBe(PublishingStatus::Draft)
        ->meta->toBeNull();
});

test('associates user, language and relationships', function () {
    /** @var Language $language */
    $language = Language::factory()->create();

    /** @var Page $originalPage */
    $originalPage = Page::factory()->create(
        ['language_id' => $language->id, 'status' => PublishingStatus::Published]
    );

    actingAs($user = User::factory()->create());

    $copyPage = (new CreateCopyAction)->handle($originalPage);

    expect($copyPage->author->id)->toBe($user->id)
        ->and($copyPage->language->id)->toBe($language->id);

    if ($originalPage->parent) {
        expect($copyPage->parent)->toBe($originalPage->parent);
    }

    if ($originalPage->translatedFrom) {
        expect($copyPage->translatedFrom)->toBe($originalPage->translatedFrom);
    }
});
