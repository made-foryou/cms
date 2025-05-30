<?php

namespace Made\Cms\Website\Models\Settings;

use Made\Cms\Page\Models\Page;
use Made\Cms\Shared\Models\UsesMadeLinkSelection;
use Spatie\LaravelSettings\Settings;

class WebsiteSetting extends Settings
{
    use UsesMadeLinkSelection;

    /**
     * Whether the website is accessible or not.
     */
    public bool $online = true;

    /**
     * Selected page id which will be used as the landing page.
     */
    public ?string $landing_page = null;

    /**
     * Selected page id which shows the privacy policy content.
     */
    public ?string $privacy_policy_page = null;

    /**
     * Selected page id which shows the cookie policy page.
     */
    public ?string $cookie_statement_page = null;

    /**
     * The menu locations that are available.
     */
    public array $menu_locations = ['default'];

    /**
     * The selected page ID which respresents the 404 Not Found page.
     */
    public ?string $not_found_page = null;

    /**
     * Check if the website is online.
     *
     * @return bool True if the website is online, false otherwise.
     */
    public function isOnline(): bool
    {
        return $this->online;
    }

    /**
     * Get the landing page.
     *
     * @return Page|null The landing page or null if not set.
     */
    public function getLandingPage(): ?Page
    {
        return $this->getPage('landing_page');
    }

    /**
     * Retrieves the page to be displayed when a requested page is not found.
     *
     * @return Page|null The not found page, or null if not set.
     */
    public function getNotFoundPage(): ?Page
    {
        return $this->getPage('not_found_page');
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
