<?php

declare(strict_types=1);

namespace Made\Cms\Language\Builders;

use Illuminate\Database\Eloquent\Builder;

class LanguageBuilder extends Builder
{
    /**
     * Selects the default selected language.
     */
    public function default(): self
    {
        return $this->where('is_default', true);
    }
}
