<?php

declare(strict_types=1);

namespace Made\Cms\Shared\Models;

use Made\Cms\Facades\Made;
use Made\Cms\Shared\Contracts\RouteableContract;

trait UsesMadeLinkSelection
{
    /**
     * Retrieves the selected Page from the given key.
     */
    public function getPage(string $key): ?RouteableContract
    {
        if (! isset($this->{$key})) {
            return null;
        }

        $value = $this->{$key};

        if (empty($value)) {
            return null;
        }

        return Made::modelFromSelection($value);
    }
}