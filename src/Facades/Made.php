<?php

declare(strict_types=1);

namespace Made\Cms\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array madeLinkOptions(?array $selected = null)
 */
class Made extends Facade
{
    public const LINK_TYPE_PAGES = 'pages';
    public const LINK_TYPE_POSTS = 'posts';

    protected static function getFacadeAccessor(): string
    {
        return \Made\Cms\Made::class;
    }
}