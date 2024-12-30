<?php

declare(strict_types=1);

namespace Made\Cms\Shared\Actions;

use Illuminate\Support\Facades\Cache;
use Lorisleiva\Actions\Concerns\AsAction;
use Made\Cms\Shared\Models\Route;

class CacheRoutesAction
{
    use AsAction;

    public const string CACHE_KEY = 'made_routes';

    public function handle(): void
    {
        if (Cache::has(self::CACHE_KEY)) {
            Cache::forget(self::CACHE_KEY);
        }

        $routes = Route::query()->get();

        Cache::forever(self::CACHE_KEY, $routes);
    }
}
