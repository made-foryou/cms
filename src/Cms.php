<?php

namespace Made\Cms;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route as RouteFacade;
use Made\Cms\Filament\Builder\ContentStrip;
use Made\Cms\Http\Controllers\Controller;
use Made\Cms\Models\Page;
use Made\Cms\Models\Settings\WebsiteSetting;
use Made\Cms\Shared\Models\Route;

class Cms
{
    public const string ALL_ROUTES = 'all';

    public const string PAGE_ROUTES = 'page';

    public const string LANDING_PAGE_ROUTE = 'landing_page';

    public const string CACHE_ROUTES = 'made_routes';

    public function __construct(
        protected WebsiteSetting $websiteSetting,
    ) {}

    /**
     * Renders the content strips into an HTML string.
     *
     * This method processes an array of content strips and generates
     * their HTML representation based on configured content blocks.
     * It checks the configuration for valid classes implementing the
     * `ContentStrip` interface and matches their IDs with the given content type.
     * If a match is found, the corresponding block's `render` method is invoked
     * to generate the respective HTML block, which is then concatenated
     * to produce the final output.
     *
     * @param  array  $content  An array of content strips, with each strip including
     *                          a 'type' to identify the content block and optional
     *                          'data' for rendering.
     * @return string The generated HTML string for the provided content strips.
     */
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

    /**
     * Retrieves a collection of routes, cached indefinitely for reuse.
     *
     * This method fetches the routes from the database or retrieves them from
     * the cache if already stored. It uses the `CACHE_ROUTES` constant as the
     * cache key to store and retrieve the data. If the cache does not exist,
     * the routes are queried from the `Route` model and cached for future access.
     *
     * @return Collection The collection of routes fetched from the database or cache.
     */
    protected function getRoutes(): Collection
    {
        return Cache::rememberForever(self::CACHE_ROUTES, function (): Collection {
            return Route::query()->get();
        });
    }

    /**
     * Configures the routes for the application based on the provided selection.
     *
     * Depending on the `selection` parameter, the method determines which
     * set of routes to generate. It supports generating all routes or page-specific
     * routes by invoking the appropriate internal method:
     * - `ALL_ROUTES`: Generates all routes, including page routes.
     * - `PAGE_ROUTES`: Generates only page routes.
     *
     * @param  string  $selection  A constant indicating the routes to be generated
     *                             (`self::ALL_ROUTES` or `self::PAGE_ROUTES`).
     */
    public function routes(string $selection = self::ALL_ROUTES): void
    {
        if (in_array($selection, [self::ALL_ROUTES, self::LANDING_PAGE_ROUTE], true)) {
            $this->generateLandingPageRoute();
        }

        if (in_array($selection, [self::ALL_ROUTES, self::PAGE_ROUTES], true)) {
            $this->generatePageRoutes();
        }
    }

    /**
     * Generates routes for pages by filtering the collection of all routes.
     *
     * This method retrieves all routes from the cache, filters them to only
     * include routes that are associated with `Page` instances, and registers
     * those routes with the application's route facade. Each route is defined
     * as handling GET requests and outputs the current request URI for debugging
     * purposes.
     *
     * This method uses the following process:
     * - Fetch all cached routes using the `getRoutes` method.
     * - Filter routes whose `routeable` attribute is an instance of `Page`.
     * - Register each filtered route using `RouteFacade::get`.
     */
    protected function generatePageRoutes(): void
    {
        $pageRoutes = $this->getRoutes()
            ->filter(fn (Route $route) => $route->routeable instanceof Page);

        $pageRoutes->each(function (Route $route) {
            RouteFacade::get($route->route, Controller::class);
        });
    }

    /**
     * Generates the landing page route for the application.
     *
     * This method retrieves the configured landing page from the `WebsiteSetting`
     * instance. If a landing page is defined, it registers a route for the root (`/`)
     * using the route facade. If no landing page is set, the method exits without
     * performing any actions.
     *
     * The generated route uses a predefined controller class to handle requests.
     *
     * This method is primarily used internally when configuring the application's routes.
     */
    protected function generateLandingPageRoute(): void
    {
        $landingPage = $this->websiteSetting->getLandingPage();

        if (empty($landingPage)) {
            return;
        }

        RouteFacade::get('/', Controller::class);
    }
}
