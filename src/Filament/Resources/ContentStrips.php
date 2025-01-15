<?php

namespace Made\Cms\Filament\Resources;

use Made\Cms\Filament\Builder\ContentStrip;

trait ContentStrips
{
    public static function contentStrips(?string $model = null): array
    {
        $strips = collect();

        $modelConfigured = config('made-cms.content.blocks.' . $model);

        if (! empty($modelConfigured)) {
            foreach ($modelConfigured as $strip) {

                if (! class_exists($strip)) {
                    continue;
                }

                if (! in_array(ContentStrip::class, class_implements($strip))) {
                    continue;
                }

                $strips->push($strip::block());

            }
        }

        $configured = config('made-cms.content.blocks.default');

        foreach ($configured as $strip) {

            if (! class_exists($strip)) {
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
