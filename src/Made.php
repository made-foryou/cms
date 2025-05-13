<?php

declare(strict_types=1);

namespace Made\Cms;

use Made\Cms\News\Models\Post;
use Made\Cms\Page\Models\Page;
use Made\Cms\Shared\Contracts\RouteableContract;

class Made
{
    public const string VERSION = '0.14.3';

    public const LINK_TYPE_PAGES = 'pages';
    public const LINK_TYPE_POSTS = 'posts';

    public function madeLinkOptions(?array $selected = null): array
    {
        $types = $this->getLinkTypes();
        $options = [];

        if (!empty($selected)) {
            $types = array_filter(
                $types,
                fn ($key) => in_array($key, $selected, true),
                ARRAY_FILTER_USE_KEY,
            );
        }

        foreach ($types as $type) {
            if (is_subclass_of($type, RouteableContract::class)) {
                $entries = $type::query()
                    ->forLinkSelection()
                    ->get();

                $options[$entries->first()->linkGroupName()] = $entries->mapWithKeys(
                    fn (RouteableContract $route) => [
                        $route->linkKey().':'.$route->getKey() => $route->linkName()
                    ], 
                )->toArray();
            }
        }

        return $options;
    }

    /**
     * @return array<string, class-string<RouteableContract>>
     */
    protected function getLinkTypes(): array
    {
        $customTypes = config('made-cms.panel.custom_link_types', []);

        return [
            'pages' => Page::class,
            'posts' => Post::class,

            ...$customTypes,
        ];
    }
}