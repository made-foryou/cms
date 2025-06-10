<?php

declare(strict_types=1);

trait HasRichEditor {

    public static function toolbarButtons(): array
    {
        return config('made-cms.settings.toolbarButtons', []);
    }

}
