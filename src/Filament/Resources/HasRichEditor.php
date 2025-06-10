<?php

declare(strict_types=1);

namespace Made\Cms\Filament\Resources;

trait HasRichEditor
{
    public static function toolbarButtons(): array
    {
        return config('made-cms.settings.toolbarButtons', []);
    }
}
