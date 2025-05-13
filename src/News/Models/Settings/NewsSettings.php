<?php

declare(strict_types=1);

namespace Made\Cms\News\Models\Settings;

use Made\Cms\Page\Models\Page;
use Made\Cms\Shared\Models\UsesMadeLinkSelection;
use Spatie\LaravelSettings\Settings;

class NewsSettings extends Settings
{
    use UsesMadeLinkSelection;

    /**
     * Selected page ID which represents the page on which the news will be displayed.
     */
    public ?string $news_page = null;

    /**
     * Retrieves the string that represents the group name.
     *
     * @return string The name of the group.
     */
    public static function group(): string
    {
        return 'news';
    }

    /**
     * Retrieves the page model that is selected from the Made link selection.
     */
    public function newsPage(): ?Page
    {
        return $this->getPage('news_page');
    }
}