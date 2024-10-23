<?php

namespace Made\Cms\Filament\Resources;

use Made\Cms\Filament\Builder\ContentStrip;

trait ContentStrips
{
    public static function contentStrips(): array
    {
        $strips = collect();

        $configured = config('made-cms.content.blocks');

        foreach ($configured as $strip) {

            if (! class_exists($strip)) {
                dump('not existing');

                continue;
            }

            if (! in_array(ContentStrip::class, class_implements($strip))) {
                continue;
            }

            $strips->push($strip::block());

        }

        return $strips->all();
    }
}
