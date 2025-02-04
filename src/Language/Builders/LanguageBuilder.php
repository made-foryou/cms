<?php

declare(strict_types=1);

namespace Made\Cms\Language\Builders;

use Illuminate\Database\Eloquent\Builder;

class LanguageBuilder extends Builder
{
    /**
     * Filters the query to include only the default records where 'is_default' is true.
     *
     * @return self Returns the current instance of the query builder with the applied condition.
     */
    public function default(): self
    {
        return $this->where('is_default', true);
    }

    /**
     * Selects the non-default language entries.
     *
     * @return self Returns the current instance of the query builder with the applied condition.
     */
    public function notDefault(): self
    {
        return $this->where('is_default', false);
    }

    /**
     * Filters the query to include only records where the 'is_enabled' field is true.
     *
     * @return self Returns the current instance of the query builder with the applied condition.
     */
    public function enabled(): self
    {
        return $this->where('is_enabled', true);
    }

    /**
     * Filters the query to include only records where the 'is_enabled' field is false.
     *
     * @return self Returns the current instance of the query builder with the applied condition.
     */
    public function notEnabled(): self
    {
        return $this->where('is_enabled', false);
    }
}
