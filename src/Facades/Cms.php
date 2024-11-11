<?php

namespace Made\Cms\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string renderContentStrips(array $content)
 * @method static array localeOptions($disabled = true)
 *
 * @extends \Made\Cms\Cms
 */
class Cms extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Made\Cms\Cms::class;
    }
}
