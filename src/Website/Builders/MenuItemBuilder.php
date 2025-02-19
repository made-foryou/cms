<?php

declare(strict_types=1);

namespace Made\Cms\Website\Builders;

use Illuminate\Database\Eloquent\Builder;

class MenuItemBuilder extends Builder
{
    public function fromLocation(string $location): self
    {
        return $this->where('location', $location);
    }

    public function onlyMainItems(): self
    {
        return $this->whereNull('parent_id');
    }
}
