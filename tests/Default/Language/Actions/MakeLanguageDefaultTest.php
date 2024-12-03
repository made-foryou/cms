<?php

namespace Made\Cms\Tests\Language\Actions;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Made\Cms\Language\Actions\MakeLanguageDefault;
use Made\Cms\Language\Models\Language;

uses(RefreshDatabase::class);

it('makes the specified language the default', function () {
    $language1 = Language::factory()->create(['is_default' => true]);
    $language2 = Language::factory()->create(['is_default' => false]);

    $action = new MakeLanguageDefault;
    $action->handle($language2);

    $language1->refresh();
    $language2->refresh();

    expect($language1->is_default)->toBeFalse();
    expect($language2->is_default)->toBeTrue();
});

it('resets other languages as non-default', function () {
    $language1 = Language::factory()->create(['is_default' => true]);
    $language2 = Language::factory()->create(['is_default' => false]);
    $language3 = Language::factory()->create(['is_default' => false]);

    $action = new MakeLanguageDefault;
    $action->handle($language3);

    $language1->refresh();
    $language2->refresh();
    $language3->refresh();

    expect($language1->is_default)->toBeFalse();
    expect($language2->is_default)->toBeFalse();
    expect($language3->is_default)->toBeTrue();
});
