<?php

namespace Made\Cms;

use Made\Cms\Filament\Builder\ContentStrip;
use Made\Cms\Models\Settings\WebsiteSetting;

class Cms
{
    public const string ALL_ROUTES = 'all';

    public const string PAGE_ROUTES = 'page';

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

    public function routes($selection = self::ALL_ROUTES): void
    {
        if (in_array($selection, [self::ALL_ROUTES, self::PAGE_ROUTES], true)) {
            $this->generatePageRoutes();
        }
    }

    protected function generatePageRoutes(): void {}
}
