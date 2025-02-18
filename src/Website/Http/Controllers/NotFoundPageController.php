<?php

declare(strict_types=1);

namespace Made\Cms\Website\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Made\Cms\App\Http\Controllers\Controller;
use Made\Cms\Website\Models\Settings\WebsiteSetting;
use Symfony\Component\HttpFoundation\Response;

class NotFoundPageController extends Controller
{
    public function __construct(
        protected readonly WebsiteSetting $websiteSetting,
    ) {}

    public function __invoke(Request $request): View | Response
    {
        if ($this->websiteSetting->not_found_page === null) {
            abort(404);
        }

        $page = $this->websiteSetting->getNotFoundPage();

        return $this->invokeController($request, $page->route);
    }
}
