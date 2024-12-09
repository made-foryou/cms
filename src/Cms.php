<?php

namespace Made\Cms;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route as RouteFacade;
use Made\Cms\Filament\Builder\ContentStrip;
use Made\Cms\Models\Page;
use Made\Cms\Models\Settings\WebsiteSetting;
use Made\Cms\Shared\Models\Route;

class Cms
{
    public const string ALL_ROUTES = 'all';

    public const string PAGE_ROUTES = 'page';

    public const string CACHE_ROUTES = 'made_routes';

    public function __construct(
        protected WebsiteSetting $websiteSetting,
    ) {}

    public function renderContentStrips(array $content): string
    {
        $configured = config('made-cms.content.blocks');

        $html = '';

        foreach ($content as $strip) {
            foreach ($configured as $block) {
                if (! class_exists($block)) {
                    continue;
                }

                if (! class_implements($block, ContentStrip::class)) {
                    continue;
                }

                if ($block::id() === $strip['type']) {
                    $html .= $block::render($strip['data'] ?? []);
                }
            }
        }

        return $html;
    }

    protected function getRoutes(): Collection
    {
        return Cache::rememberForever(self::CACHE_ROUTES, function (): Collection {
            return Route::query()->get();
        });
    }

    public function routes($selection = self::ALL_ROUTES): void
    {
        if (in_array($selection, [self::ALL_ROUTES, self::PAGE_ROUTES], true)) {
            $this->generatePageRoutes();
        }
    }

    protected function generatePageRoutes(): void
    {
        $pageRoutes = $this->getRoutes()
            ->filter(fn (Route $route) => $route->routeable instanceof Page);

        $pageRoutes->each(function (Route $route) {
            RouteFacade::get($route->route, function () {
                dd(request()->getUri());
            });
        });
    }
}
