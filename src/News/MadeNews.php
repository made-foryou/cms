<?php

declare(strict_types=1);

namespace Made\Cms\News;

use Illuminate\Database\Eloquent\Collection;
use Made\Cms\News\Models\Post;

class MadeNews
{
    public function news(): Collection
    {
        return Post::query()
            ->published()
            ->overview()
            ->get();
    }
}