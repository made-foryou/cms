<?php

namespace Made\Cms\Page\Actions;

use Exception;
use Lorisleiva\Actions\Concerns\AsAction;
use Made\Cms\Language\Models\Language;
use Made\Cms\Page\Models\Page;

class CreateTranslationAction
{
    use AsAction;

    /**
     * Checks if the provided page is the main page.
     *
     * @param  Page  $page  The page to be checked.
     * @return bool Returns true if the page is the main page, false otherwise.
     */
    protected function isMainPage(Page $page): bool
    {
        return $page->translatedFrom === null;
    }

    /**
     * Retrieves the main page associated with the given page.
     *
     * @param  Page  $page  The page object from which the main page is to be retrieved.
     * @return Page The main page that the provided page is translated from.
     */
    protected function getMainPage(Page $page): Page
    {
        return $page->translatedFrom;
    }

    /**
     * Handles the translation process for the given page into the specified language.
     *
     * @param  Page  $page  The page to be translated.
     * @param  Language  $language  The target language for the translation.
     * @return Page The newly created translation page.
     *
     * @throws Exception If a translation for the specified language already exists.
     */
    public function handle(Page $page, Language $language): Page
    {
        $main = $page;

        if ($this->isMainPage($page) === false) {
            $main = $this->getMainPage($page);
        }

        if ($main->language_id === $language->id) {
            throw new Exception('Er bestaat al een vertaling voor de taal ' . $language->name);
        }

        $filtered = $main->translations->filter(
            fn (Page $translation) => $translation->language_id === $language->id
        );

        if ($filtered->isNotEmpty()) {
            throw new Exception('Er bestaat al een vertaling voor de taal ' . $language->name);
        }

        $translation = CreateCopyAction::run($page);
        $translation->translatedFrom()->associate($main);
        $translation->language()->associate($language);
        $translation->save();

        return $translation;
    }
}
