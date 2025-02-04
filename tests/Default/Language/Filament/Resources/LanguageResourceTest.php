<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Made\Cms\Language\Filament\Resources\LanguageResource;
use Made\Cms\Language\Models\Language;

uses(RefreshDatabase::class);

it('is connected to the Language model', function () {
    expect(LanguageResource::getModel())
        ->toBe(Language::class);
});

it('is has a predefined slug', function () {
    expect(LanguageResource::getSlug())
        ->toBe('languages');
});

it('is has a predefined navigation sort', function () {
    expect(LanguageResource::getNavigationSort())
        ->toBe(8);
});

it('has a navigation badge', function () {
    Language::factory()->count(20)->create();

    $enabled = Language::query()->enabled()->count();

    expect(LanguageResource::getNavigationBadge())
        ->toBe((string) $enabled);
});
