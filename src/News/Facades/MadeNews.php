<?php

declare(strict_types=1);

namespace Made\Cms\News\Facades;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Facade;
use Made\Cms\News\MadeNews as NewsMadeNews;
use Made\Cms\News\Models\Post;
use Made\Cms\News\QueryBuilders\PostQueryBuilder;
use Made\Cms\Page\Models\Page;

/**
 * @method static PostQueryBuilder<Post> news()
 * @method static Collection<Post> nextPosts(Post $post, int $numberOfItems = 3)
 * @method static ?Page overviewPage()
 *
 * @see \Made\Cms\News\MadeNews
 */
class MadeNews extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return NewsMadeNews::class;
    }
}
