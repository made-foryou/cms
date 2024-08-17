<?php

namespace Made\Cms\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Made\Cms\Cms
 */
class Cms extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Made\Cms\Cms::class;
    }
}
