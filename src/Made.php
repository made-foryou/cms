<?php

declare(strict_types=1);

namespace Made\Cms;

use Made\Cms\News\Models\Post;
use Made\Cms\Page\Models\Page;
use Made\Cms\Shared\Contracts\RouteableContract;

class Made
{
    public const string VERSION = '0.15.9';

    public const LINK_TYPE_PAGES = 'page';

    public const LINK_TYPE_POSTS = 'post';

    public function madeLinkOptions(?array $selected = null): array
    {
        $types = $this->getLinkTypes();
        $options = [];

        if (! empty($selected)) {
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
                        $route->linkKey() . ':' . $route->getKey() => $route->linkName(),
                    ],
                )->toArray();
            }
        }

        return $options;
    }

    /**
     * Get the model from the selection string.
     *
     * @param  string  $selection  The selection string in the format "type:id".
     * @return RouteableContract|null The model instance or null if not found.
     */
    public function modelFromSelection(string $selection): ?RouteableContract
    {
        $parts = explode(':', $selection);

        if (count($parts) !== 2) {
            return null;
        }

        [$type, $id] = $parts;

        $types = $this->getLinkTypes();

        if (! array_key_exists($type, $types)) {
            return null;
        }

        return $types[$type]::findOrFail($id);
    }

    /**
     * @return array<string, class-string<RouteableContract>>
     */
    protected function getLinkTypes(): array
    {
        $customTypes = config('made-cms.panel.custom_link_types', []);

        return [
            self::LINK_TYPE_PAGES => Page::class,
            self::LINK_TYPE_POSTS => Post::class,

            ...$customTypes,
        ];
    }
}
