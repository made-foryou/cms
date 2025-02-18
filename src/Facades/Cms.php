<?php

namespace Made\Cms\Facades;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * @method static string renderContentStrips(array $content) Renders the content strips into an HTML string.
 * @method static void routes(string $selection = 'all') Configures the routes for the application based on the provided selection.
 * @method static string url(RouteableContract|Route $route, array $parameters = [], ?bool $secure = null) Generates a URL based on the given parameters.
 * @method static Collection navigationItems(string $location) Gather the menu items from a menu location.
 *
 * @mixin \Made\Cms\Cms
 */
class Cms extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Made\Cms\Cms::class;
    }
}
