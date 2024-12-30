<?php

namespace Made\Cms\Shared\Observers;

use Illuminate\Support\Facades\Cache;
use Made\Cms\Shared\Models\Route;

class RouteObserver
{
    public const string CACHE_ROUTES = 'made_routes';

    public function saved(Route $route): void
    {
        Cache::delete(self::CACHE_ROUTES);
    }

    public function deleted(Route $route): void
    {
        Cache::delete(self::CACHE_ROUTES);
    }
}
