<?php

declare(strict_types=1);

namespace Made\Cms\Facades;

use Illuminate\Support\Facades\Facade;
use Made\Cms\Made as CmsMade;

/**
 * @method static array madeLinkOptions(?array $selected = null)
 * @method static RouteableContract|null modelFromSelection(string $selection)
 */
class Made extends Facade
{
    public const LINK_TYPE_PAGES = CmsMade::LINK_TYPE_PAGES;
    
    public const LINK_TYPE_POSTS = CmsMade::LINK_TYPE_POSTS;

    protected static function getFacadeAccessor(): string
    {
        return \Made\Cms\Made::class;
    }
}
