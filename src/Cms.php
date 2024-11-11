<?php

namespace Made\Cms;

use Made\Cms\Filament\Builder\ContentStrip;
use Made\Cms\Models\Settings\WebsiteSetting;

class Cms
{
    public function __construct(
        protected WebsiteSetting $websiteSetting,
    ) {}

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

    public function localeOptions($disabled = true): array
    {
        return $this->websiteSetting->getLocales()
            ->filter(fn (array $locale) => ($disabled === true || $locale['enabled'] === true))
            ->mapWithKeys(fn (array $locale) => [$locale['code'] => $locale['name']])
            ->toArray();
    }
}
