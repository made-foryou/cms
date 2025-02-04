<?php

namespace Made\Cms\Tests\Page\QueryBuilders;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Made\Cms\Page\Models\Page;
use Made\Cms\Page\QueryBuilders\PageQueryBuilder;
use Made\Cms\Shared\Enums\PublishingStatus;

uses(RefreshDatabase::class);

test('the page model uses the querybuilder', function () {
    $query = Page::query();

    expect($query)->toBeInstanceOf(PageQueryBuilder::class);
});

it('can select for the status', function () {
    $query = Page::query();
    $query = $query->whereStatus(PublishingStatus::Published);

    expect($query->toSql())
        ->toBe('select * from "made_cms_pages" where "status" = ? and "made_cms_pages"."deleted_at" is null')
        ->and($query->getBindings())
        ->toBe([PublishingStatus::Published->value]);
});

it('can select for published pages', function () {
    $query = Page::query();
    $query = $query->published();

    expect($query->toSql())
        ->toBe('select * from "made_cms_pages" where "status" = ? and "made_cms_pages"."deleted_at" is null')
        ->and($query->getBindings())
        ->toBe([PublishingStatus::Published->value]);
});

it('can select for draft pages', function () {
    $query = Page::query();
    $query = $query->draft();

    expect($query->toSql())
        ->toBe('select * from "made_cms_pages" where "status" = ? and "made_cms_pages"."deleted_at" is null')
        ->and($query->getBindings())
        ->toBe([PublishingStatus::Draft->value]);
});
