<?php

namespace Made\Cms\Analytics\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class VisitQueryBuilder extends Builder
{
    /**
     * Filters the results to only include records with a "created_at" date matching the current date.
     */
    public function today(): self
    {
        return $this->whereDate('created_at', '=', now()->format('Y-m-d'));
    }

    /**
     * Filters the results to only include records where the "created_at" date is earlier than the given threshold.
     *
     * @param  Carbon  $carbon  The date threshold to compare against.
     */
    public function pastThreshold(Carbon $carbon): VisitQueryBuilder
    {
        return $this->where('created_at', '<', $carbon);
    }
}
