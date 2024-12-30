<?php

declare(strict_types=1);

namespace Made\Cms\Shared\Actions;

use Lorisleiva\Actions\Concerns\AsAction;
use Made\Cms\Shared\Models\Route;

class GetControllerFromRouteable
{
    use AsAction;

    public function handle(Route $route): ?string
    {
        $options = $this->getControllerSettings();

        $routeable = get_class($route->routeable);

        if (isset($options[$routeable])) {
            return $options[$routeable];
        }

        if (isset($options['default'])) {
            return $options['default'];
        }

        return null;
    }

    protected function getControllerSettings(): array
    {
        return config('made-cms.routing.controllers');
    }
}
