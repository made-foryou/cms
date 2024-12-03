<?php

declare(strict_types=1);

namespace Made\Cms\Language\Actions;

use Lorisleiva\Actions\Concerns\AsAction;
use Made\Cms\Language\Models\Language;

class MakeLanguageDefault
{
    use AsAction;

    /**
     * Makes the given language the new default language.
     *
     * Only one language can be default so the current default language will be
     * made not default.
     */
    public function handle(Language $language): void
    {
        // Reset other default languages
        Language::query()
            ->where('is_default', true)
            ->update(['is_default' => false]);

        $language->is_default = true;
        $language->save();
    }
}
