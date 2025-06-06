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
        $found = Post::query()
            ->overview()
            ->published()
            ->where('date', '>=', $post->date)
            ->where('id', '!=', $post->id)
            ->limit($numberOfItems)
            ->get();

        if ($found->count() < $numberOfItems) {
            $extra = Post::query()
                ->overview()
                ->published()
                ->whereNotIn('id', $found->pluck('id')->add($post->id)->toArray())
                ->limit($numberOfItems - $found->count())
                ->get();

            return $found->merge($extra);
        }

        return $found;
    }

    public function overviewPage(): ?Page
    {
        return $this->settings->newsPage();
    }
}
