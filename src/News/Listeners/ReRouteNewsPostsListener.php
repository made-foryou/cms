<?php

declare(strict_types=1);

namespace Made\Cms\News\Listeners;

use Made\Cms\News\Actions\ReRouteNewsPostsAction;
use Made\Cms\News\Models\Settings\NewsSettings;
use Spatie\LaravelSettings\Events\SettingsSaved;

class ReRouteNewsPostsListener
{
    public function handle(SettingsSaved $event): void
    {
        if (! $event->settings instanceof NewsSettings) {
            return;
        }

        /**
         * @todo: Make a pull request for the spatie-settings package, in which you add the
         *        possibility to test the old value against the newly changed value after
         *        saving.
         */
        ReRouteNewsPostsAction::run();
    }
}
