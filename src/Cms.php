<?php

namespace Made\Cms;

use Made\Cms\Filament\Builder\ContentStrip;

class Cms
{
    public function renderContentStrips(array $content): string
    {
        $configured = config('made-cms.content.blocks');

        $html = '';

        foreach ($content as $strip) {
            foreach ($configured as $block) {
                if (! class_exists($block)) {
                    continue;
                }

                if (! class_implements($block, ContentStrip::class)) {
                    continue;
                }

                if ($block::id() === $strip['type']) {
                    $html .= $block::render($strip['data'] ?? []);
                }
            }
        }

        return $html;
    }
}
