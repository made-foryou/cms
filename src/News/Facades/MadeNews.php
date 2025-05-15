<?php

declare(strict_types=1);

namespace Made\Cms\News\Facades;

use Illuminate\Support\Facades\Facade;
use Made\Cms\News\MadeNews as NewsMadeNews;

/**
 * @method static \Illuminate\Database\Eloquent\Collection news()
 *
 * @see \Made\Cms\News\MadeNews
 */
class MadeNews extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return NewsMadeNews::class;
    }
}