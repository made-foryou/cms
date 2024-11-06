<?php

namespace Made\Cms\Models\Settings;

use Spatie\LaravelSettings\Settings;

class WebsiteSetting extends Settings
{
    /**
     * Whether the website is accessible or not.
     */
    public bool $online = true;

    /**
     * Checks if the website is currently online.
     *
     * @return bool True if the website is online, false otherwise.
     */
    public function isOnline(): bool
    {
        return $this->online;
    }

    /**
     * Retrieves the string that represents the group name.
     *
     * @return string The name of the group.
     */
    public static function group(): string
    {
        return 'web';
    }
}
