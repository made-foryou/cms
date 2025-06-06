<?php

declare(strict_types=1);

namespace Made\Cms;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route as RouteFacade;
use Illuminate\Support\Facades\Schema;
use Made\Cms\App\Http\Controllers\Controller;
use Made\Cms\Filament\Builder\ContentStrip;
use Made\Cms\News\Models\Post;
use Made\Cms\Page\Models\Page;
use Made\Cms\Shared\Contracts\RouteableContract;
use Made\Cms\Shared\Database\HasDatabaseTablePrefix;
use Made\Cms\Shared\Models\Route;
use Made\Cms\Website\Http\Controllers\NotFoundPageController;
use Made\Cms\Website\Models\MenuItem;
use Made\Cms\Website\Models\Settings\WebsiteSetting;

class Cms
{
    use HasDatabaseTablePrefix;

    public const string VERSION = '0.15.9';

    public const string ALL_ROUTES = 'all';

    public const string PAGE_ROUTES = 'page';

    public const string NEWS_ROUTES = 'news';

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

            // Search for the right ContentStrip.
            foreach ($configured as $type) {
                foreach ($type as $block) {
                    if (! class_exists($block)) {
                        continue;
                    }

                    $interfaces = class_implements($block);

                    if (empty($interfaces) || ! in_array(ContentStrip::class, $interfaces)) {
                        continue;
                    }

                    if ($block::id() === $strip['type']) {
                        $html .= $block::render($strip['data'] ?? []);
                    }
                }
            }
        }

        return $html;
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
        if (app()->runningInConsole()) {
            return;
        }

        if (! $this->databaseWasConfigured()) {
            return;
        }

        if (in_array($selection, [self::ALL_ROUTES, self::LANDING_PAGE_ROUTE], true)) {
            $this->generateLandingPageRoute();
        }

        if (in_array($selection, [self::ALL_ROUTES, self::PAGE_ROUTES], true)) {
            $this->generatePageRoutes();
        }

        if (in_array($selection, [self::ALL_ROUTES, self::NEWS_ROUTES], true)) {
            $this->generateNewsRoutes();
        }

        if ($this->websiteSetting->not_found_page !== null) {
            RouteFacade::fallback(NotFoundPageController::class);
        }
    }

    /**
     * Generates a URL based on the given parameters.
     *
     * @param  RouteableContract|Route  $route  The RouteableContract model or the route itself to
     *                                          generate the url from.
     * @param  array  $parameters  Optional. An associative array of query parameters to append to the URL.
     * @param  bool  $secure  Optional. Whether to generate a secure (HTTPS) URL. Default is false.
     * @return string The generated URL.
     */
    public function url(
        RouteableContract | Route $route,
        array $parameters = [],
        ?bool $secure = null
    ): string {
        if ($route instanceof RouteableContract) {
            $route = $route->route;
        }

        $landingPage = $this->websiteSetting->getLandingPage();

        if (! empty($landingPage) && $landingPage->route->id === $route->id) {
            return url('/', $parameters, $secure);
        }

        return url($route->route, $parameters, $secure);
    }

    /**
     * Gather the menu items from a menu location.
     *
     * @param  string  $location  The menu location from which you want to get the menu items.
     * @return Collection Collection of the menu items.
     */
    public function navigationItems(string $location): Collection
    {
        $menuItems = MenuItem::query()
            ->fromLocation($location)
            ->onlyMainItems()
            ->with(['children', 'linkable'])
            ->orderBy('index', 'ASC')
            ->get();

        return $menuItems;
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
     * Generates routes for news posts by filtering the collection of all routes.
     *
     * This method retrieves all routes from the cache, filters them to only
     * include routes that are associated with `Post` instances, and registers
     * those routes with the application's route facade. Each route is defined
     * as handling GET requests and outputs the current request URI for debugging
     * purposes.
     *
     * This method uses the following process:
     * - Fetch all cached routes using the `getRoutes` method.
     * - Filter routes whose `routeable` attribute is an instance of `Post`.
     * - Register each filtered route using `RouteFacade::get`.
     */
    protected function generateNewsRoutes(): void
    {
        $newsRoutes = $this->getRoutes()
            ->filter(fn (Route $route) => $route->routeable instanceof Post);

        $newsRoutes->each(function (Route $route) {
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
        if (app()->runningInConsole() === true) {
            return Cache::get(self::CACHE_ROUTES, collect([]));
        }

        return Cache::rememberForever(self::CACHE_ROUTES, function (): Collection {
            return Route::query()->get();
        });
    }

    /**
     * Checks if the routes table exists in the database.
     *
     * This method verifies the existence of the "routes" table by querying the database.
     * It uses the given table prefix, if any, to locate the correct table name.
     *
     * @return bool Returns true if the routes table exists, otherwise false.
     */
    protected function databaseWasConfigured(): bool
    {
        return Schema::hasTable($this->prefixTableName('settings'))
            && DB::table($this->prefixTableName('settings'))->where('group', 'web')->first() !== null;
    }
}
