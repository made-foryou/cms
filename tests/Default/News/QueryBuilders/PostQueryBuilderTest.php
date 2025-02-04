<?php

namespace Made\Cms\Tests\News\QueryBuilders;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Made\Cms\News\Models\Post;
use Made\Cms\News\QueryBuilders\PostQueryBuilder;
use Made\Cms\Shared\Enums\PublishingStatus;

uses(RefreshDatabase::class);

test('the post model uses the querybuilder', function () {
    $query = Post::query();

    expect($query)->toBeInstanceOf(PostQueryBuilder::class);
});

it('can select for the status', function () {
    $query = Post::query();
    $query = $query->whereStatus(PublishingStatus::Published);

    expect($query->toSql())
        ->toBe('select * from "made_cms_posts" where "status" = ? and "made_cms_posts"."deleted_at" is null')
        ->and($query->getBindings())
        ->toBe([PublishingStatus::Published->value]);
});

it('can select for published pages', function () {
    $query = Post::query();
    $query = $query->published();

    expect($query->toSql())
        ->toBe('select * from "made_cms_posts" where "status" = ? and "made_cms_posts"."deleted_at" is null')
        ->and($query->getBindings())
        ->toBe([PublishingStatus::Published->value]);
});

it('can select for draft pages', function () {
    $query = Post::query();
    $query = $query->draft();

    expect($query->toSql())
        ->toBe('select * from "made_cms_posts" where "status" = ? and "made_cms_posts"."deleted_at" is null')
        ->and($query->getBindings())
        ->toBe([PublishingStatus::Draft->value]);
});
