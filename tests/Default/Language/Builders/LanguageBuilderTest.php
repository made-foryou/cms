<?php

namespace Made\Cms\Tests\Language\Builders;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Made\Cms\Language\Builders\LanguageBuilder;
use Made\Cms\Language\Models\Language;

uses(RefreshDatabase::class);

test('language model uses the language builder', function () {
    $query = Language::query();

    expect($query)->toBeInstanceOf(LanguageBuilder::class);
});

it('can select for default languages', function () {
    $query = Language::query()->default();

    expect($query->toSql())
        ->toBe('select * from "made_cms_languages" where "is_default" = ? and "made_cms_languages"."deleted_at" is null')
        ->and($query->getBindings())
        ->toBe([true]);
});

it('can select for not default languages', function () {
    $query = Language::query()->notDefault();

    expect($query->toSql())
        ->toBe('select * from "made_cms_languages" where "is_default" = ? and "made_cms_languages"."deleted_at" is null')
        ->and($query->getBindings())
        ->toBe([false]);
});

it('can select for enabled languages', function () {
    $query = Language::query()->enabled();

    expect($query->toSql())
        ->toBe('select * from "made_cms_languages" where "is_enabled" = ? and "made_cms_languages"."deleted_at" is null')
        ->and($query->getBindings())
        ->toBe([true]);
});

it('can select for not enabled languages', function () {
    $query = Language::query()->notEnabled();

    expect($query->toSql())
        ->toBe('select * from "made_cms_languages" where "is_enabled" = ? and "made_cms_languages"."deleted_at" is null')
        ->and($query->getBindings())
        ->toBe([false]);
});
