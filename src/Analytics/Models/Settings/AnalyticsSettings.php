<?php

namespace Made\Cms\Analytics\Models\Settings;

use Spatie\LaravelSettings\Settings;

class AnalyticsSettings extends Settings
{
    public array $ip_blacklist = [];

    /**
     * Retrieves the group name.
     *
     * @return string The name of the group.
     */
    public static function group(): string
    {
        return 'analytics';
    }
}
