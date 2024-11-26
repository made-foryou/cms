<?php

namespace Made\Cms\Models\Settings;

use Illuminate\Support\Collection;
use Made\Cms\Models\Page;
use Spatie\LaravelSettings\Settings;

class WebsiteSetting extends Settings
{
    /**
     * Whether the website is accessible or not.
     */
    public bool $online = true;

    /**
     * Selected page id which will be used as the landing page.
     */
    public ?int $landing_page = null;

    public array $locales = [];

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
     * Retrieves the landing page.
     *
     * @return Page|null The landing page if it exists, null otherwise.
     */
    public function getLandingPage(): ?Page
    {
        if ($this->landing_page === null) {
            return null;
        }

        return Page::findOrFail($this->landing_page);
    }

    public function getLocales(): Collection
    {
        return collect($this->locales);
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
