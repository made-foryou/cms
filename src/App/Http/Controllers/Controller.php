<?php

declare(strict_types=1);

namespace Made\Cms\App\Http\Controllers;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Made\Cms\Analytics\Models\Visit;
use Made\Cms\Shared\Actions\GetControllerFromRouteable;
use Made\Cms\Shared\Models\Route;
use Made\Cms\Website\Models\Settings\WebsiteSetting;
use Symfony\Component\HttpFoundation\Response;

class Controller extends BaseController
{
    /**
     * Initializes the class with the provided WebsiteSetting instance.
     *
     * @param  WebsiteSetting  $websiteSetting  The website setting object required for configuration.
     */
    public function __construct(
        protected readonly WebsiteSetting $websiteSetting,
    ) {
        //
    }

    /**
     * Handles incoming HTTP requests and determines the appropriate route or response based on the URI.
     * Resolves the landing page or specific route and invokes the associated controller if found.
     * Returns error responses for missing routes or when the website is offline.
     *
     * @param  Request  $request  The HTTP request containing the URI to process.
     * @return mixed Returns the result of invoking the associated route controller or aborts with an error response.
     */
    public function __invoke(Request $request)
    {
        $uri = $request->getRequestUri();

        if (strlen(trim($uri, '/')) === 0) {
            // Landing page
            $page = $this->websiteSetting->getLandingPage();

            if (empty($page) || empty($page->route)) {
                $this->saveResponseWithVisit($request, null, 404);

                abort(404);
            }

            if ($this->websiteSetting->isOnline() === false) {
                $this->saveResponseWithVisit($request, $page->route, 503);

                abort(503);
            }

            return $this->invokeController($request, $page->route);
        }

        $route = Route::query()
            ->where('route', '=', '/' . trim($uri, '/'))
            ->first();

        if (empty($route)) {
            $this->saveResponseWithVisit($request, $route, 404);

            abort(404);
        }

        if ($this->websiteSetting->isOnline() === false) {
            $this->saveResponseWithVisit($request, $route, 503);

            abort(503);
        }

        return $this->invokeController($request, $route);
    }

    /**
     * Invokes the controller associated with the given route and processes its response.
     * If no controller class is found, it triggers a 404 error.
     *
     * @param  Request  $request  The HTTP request passed to the controller.
     * @param  Route|null  $route  The optional route used to determine the controller and routeable context.
     * @return View|Response The response or view returned by the invoked controller.
     */
    protected function invokeController(
        Request $request,
        ?Route $route = null
    ): View | Response {
        if ($route === null) {
            abort(404);
        }

        /** @var null|class-string<CmsRoutingContract> $class */
        $class = GetControllerFromRouteable::run($route);

        if (empty($class)) {
            abort(404);
        }

        $controller = app()->make($class);

        $response = $controller($request, $route->routeable);

        if ($response instanceof Responsable) {
            $response = $response->toResponse($request);
        }

        $this->saveResponseWithVisit($request, $route, $response);

        return $response;
    }

    /**
     * Saves the response code and associates the visit with the given route if applicable.
     * Updates and refreshes the Visit object associated with the request.
     *
     * @param  Request  $request  The HTTP request containing the visit data.
     * @param  Route|null  $route  The optional route to associate with the visit.
     * @param  Response|View|int  $response  The response, view, or integer status code to be processed.
     */
    protected function saveResponseWithVisit(
        Request $request,
        ?Route $route,
        Response | View | int $response
    ): void {
        if (! $request->has('visit')) {
            return;
        }

        /** @var Visit $visit */
        $visit = $request->get('visit');

        if ($response instanceof View) {
            $visit->update([
                'response_code' => 200,
            ]);
        } else {
            $visit->update([
                'response_code' => (is_numeric($response)
                    ? $response
                    : $response->getStatusCode()),
            ]);
        }

        if (! empty($route)) {
            $visit->route()->associate($route);
        }

        $visit->save();
        $visit->refresh();
    }
}
