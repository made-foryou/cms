<?php

namespace Made\Cms\Page\Actions;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Lorisleiva\Actions\Concerns\AsAction;
use Made\Cms\Language\Models\Language;
use Made\Cms\Page\Models\Page;

/**
 * @method static Model run(Model $model, Language $language)
 */
class CreateTranslationAction
{
    use AsAction;

    /**
     * Checks if the provided page is the main page.
     *
     * @param  Model  $model  The page to be checked.
     * @return bool Returns true if the page is the main page, false otherwise.
     */
    protected function isMainModel(Model $model): bool
    {
        return $model->translatedFrom === null;
    }

    /**
     * Retrieves the main page associated with the given page.
     *
     * @param  Model  $model  The page object from which the main page is to be retrieved.
     * @return Model The main page that the provided page is translated from.
     */
    protected function getMainModel(Model $model): Model
    {
        return $model->translatedFrom;
    }

    /**
     * Handles the translation process for the given page into the specified language.
     *
     * @param  Model  $model  The page to be translated.
     * @param  Language  $language  The target language for the translation.
     * @return Model The newly created translation page.
     *
     * @throws Exception If a translation for the specified language already exists.
     */
    public function handle(Model $model, Language $language): Model
    {
        $main = $model;

        if ($this->isMainModel($model) === false) {
            $main = $this->getMainModel($model);
        }

        if ($main->language_id === $language->id) {
            throw new Exception('Er bestaat al een vertaling voor de taal ' . $language->name);
        }

        $filtered = $main->translations->filter(
            fn (Model $translation) => $translation->language_id === $language->id
        );

        if ($filtered->isNotEmpty()) {
            throw new Exception('Er bestaat al een vertaling voor de taal ' . $language->name);
        }

        $translation = CreateCopyAction::run($model);
        $translation->translatedFrom()->associate($main);
        $translation->language()->associate($language);
        $translation->save();

        return $translation;
    }
}
