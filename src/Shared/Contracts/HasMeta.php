<?php

namespace Made\Cms\Shared\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Made\Cms\Shared\Models\Meta;

/**
 * @mixin Model
 *
 * @property-read Meta|null $meta
 */
interface HasMeta
{
    public function meta(): MorphOne;
}
