<?php

declare(strict_types=1);

namespace Made\Cms\Page\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;
use Made\Cms\Shared\Enums\PublishingStatus;

class PageQueryBuilder extends Builder
{
    /**
     * Filters the query based on the provided publishing status.
     *
     * @param  PublishingStatus  $status  The publishing status to filter by.
     * @return self Returns the current query instance after applying the filter.
     */
    public function whereStatus(PublishingStatus $status): self
    {
        return $this->where('status', '=', $status->value);
    }

    /**
     * Filters the query to include only items with a status of 'Draft'.
     *
     * @return self Returns the current query instance, filtered by 'Draft' status.
     */
    public function draft(): self
    {
        return $this->whereStatus(PublishingStatus::Draft);
    }

    /**
     * Filters the query to include only items with a status of 'Published'.
     *
     * @return self Returns the current query instance, filtered by 'Published' status.
     */
    public function published(): self
    {
        return $this->whereStatus(PublishingStatus::Published);
    }
}
