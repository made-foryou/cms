<?php

declare(strict_types=1);

namespace Made\Cms\News\Facades;

use Illuminate\Support\Facades\Facade;
use Made\Cms\News\MadeNews as NewsMadeNews;
use Made\Cms\Page\Models\Page;

/**
 * @method static \Illuminate\Database\Eloquent\Collection news()
 * @method static ?Page overviewPage()
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
