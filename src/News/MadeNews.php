<?php

declare(strict_types=1);

namespace Made\Cms\News;

use Illuminate\Database\Eloquent\Collection;
use Made\Cms\News\Models\Post;
use Made\Cms\News\Models\Settings\NewsSettings;
use Made\Cms\News\QueryBuilders\PostQueryBuilder;
use Made\Cms\Page\Models\Page;

class MadeNews
{
    public function __construct(
        protected readonly NewsSettings $settings
    ) {}

    public function news(): PostQueryBuilder
    {
        return Post::query()
            ->overview()
            ->published();
    }

    /**
     * @return Collection<int, Post>
     */
    public function nextPosts(Post $post, int $numberOfItems = 3): Collection
    {
        return Post::query()
            ->overview()
            ->published()
            ->where('date', '>=', $post->date)
            ->limit($numberOfItems)
            ->get();
    }

    public function overviewPage(): ?Page
    {
        return $this->settings->newsPage();
    }
}
