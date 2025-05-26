<?php

declare(strict_types=1);

namespace Made\Cms\News\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;
use Made\Cms\News\Models\Post;
use Made\Cms\Shared\QueryBuilders\HasPublishingStatusColumn;

/**
 * @extends Builder<Post>
 *
 * @method PostQueryBuilder published()
 */
class PostQueryBuilder extends Builder
{
    use HasPublishingStatusColumn;

    public function overview(): PostQueryBuilder
    {
        return $this->orderBy('date', 'desc');
    }
}
