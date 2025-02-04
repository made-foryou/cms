<?php

declare(strict_types=1);

namespace Made\Cms\News\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;
use Made\Cms\Shared\QueryBuilders\HasPublishingStatusColumn;

class PostQueryBuilder extends Builder
{
    use HasPublishingStatusColumn;
}
