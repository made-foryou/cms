<?php

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Made\Cms\Models\Language;

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;

uses(RefreshDatabase::class);

it('has a prefixed table name', function () {
    $model = new Language;

    expect($model->getTable())->toBe('made_cms_languages');
});

it('can be created', function () {
    $model = Language::factory()->createOne();

    assertDatabaseCount($model->getTable(), 1);
    assertDatabaseHas($model->getTable(), [
        'name' => $model->name,
    ]);

    expect($model)->toBeInstanceOf(Language::class);
});

it('can be made default', function () {
    /** @var Collection<Language> $models */
    $models = Language::factory()->count(5)->create();

    /** @var Language $language */
    $language = $models->random(1)->first();

    \Made\Cms\Language\Actions\MakeLanguageDefault::run($language);

    assertDatabaseHas($language->getTable(), [
        'name' => $language->name,
        'is_default' => '1',
    ]);

    expect(Language::query()->where('is_default', '1')->count())
        ->toBe(1);
});

it('knows if it is default', function () {
    /** @var Language $language */
    $language = Language::factory()->default()->createOne();

    expect($language->is_default)->toBe(true);

    $language = Language::factory()->createOne();

    $language->refresh();

    expect($language->is_default)->toBe(false);
});

it('can have pages', function () {
    $language = Language::factory()->default()->createOne();

    $pages = \Made\Cms\Models\Page::factory()->count(10)->createQuietly([
        'language_id' => $language,
    ]);

    expect($language->pages->count())->toBe(10);
});
