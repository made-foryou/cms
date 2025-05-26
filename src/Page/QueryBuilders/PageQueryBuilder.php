<?php

declare(strict_types=1);

namespace Made\Cms\Page\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;
use Made\Cms\Page\Models\Page;
use Made\Cms\Shared\QueryBuilders\HasPublishingStatusColumn;

/**
 * @extends Builder<Page>
 */
class PageQueryBuilder extends Builder
{
    use HasPublishingStatusColumn;
}
