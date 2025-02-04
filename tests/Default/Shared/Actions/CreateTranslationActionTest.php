<?php

namespace Made\Cms\Tests\Shared\Actions;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Made\Cms\Language\Models\Language;
use Made\Cms\News\Models\Post;
use Made\Cms\Page\Actions\CreateTranslationAction;
use Made\Cms\Page\Models\Page;
use Made\Cms\Shared\Enums\PublishingStatus;

uses(RefreshDatabase::class);

test('it creates a translation from a page', function () {
    $languages = Language::factory()->count(2)->create();

    $original = Page::factory()->create([
        'language_id' => $languages->first()->id,
        'status' => PublishingStatus::Published,
    ]);

    $translation = CreateTranslationAction::run(
        $original,
        $languages->last(),
        $original->createdBy
    );

    expect($translation)->name->toBe($original->name)
        ->slug->toBe($original->slug)
        ->status->toBe(PublishingStatus::Draft)
        ->content->toBe($original->content)
        ->language_id->toBe($languages->last()->id);
});

test('it creates a translation from a post', function () {
    $languages = Language::factory()->count(2)->create();

    $original = Post::factory()->create([
        'language_id' => $languages->first()->id,
        'status' => PublishingStatus::Published,
    ]);

    $translation = CreateTranslationAction::run(
        $original,
        $languages->last(),
        $original->createdBy
    );

    expect($translation)->name->toBe($original->name)
        ->slug->toBe($original->slug)
        ->status->toBe(PublishingStatus::Draft)
        ->content->toBe($original->content)
        ->language_id->toBe($languages->last()->id);
});
