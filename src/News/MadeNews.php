<?php

declare(strict_types=1);

namespace Made\Cms\News;

use Illuminate\Database\Eloquent\Collection;
use Made\Cms\News\Models\Post;
use Made\Cms\News\Models\Settings\NewsSettings;
use Made\Cms\Page\Models\Page;

class MadeNews
{
    public function __construct(
        protected readonly NewsSettings $settings
    ) { }

    public function news(): Collection
    {
        return Post::query()
            ->published()
            ->overview()
            ->get();
    }

    public function overviewPage(): ?Page
    {
        return $this->settings->newsPage();
    }
}
