<?php

namespace Made\Cms\Shared\Observers;

use Made\Cms\Shared\Models\Route;

class RouteObserver
{
    public function saved(Route $route): void {}

    public function deleted(Route $route): void {}
}
