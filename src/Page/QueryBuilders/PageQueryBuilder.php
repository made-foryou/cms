<?php

declare(strict_types=1);

namespace Made\Cms\Page\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;
use Made\Cms\Shared\QueryBuilders\HasPublishingStatusColumn;

class PageQueryBuilder extends Builder
{
    use HasPublishingStatusColumn;
}
