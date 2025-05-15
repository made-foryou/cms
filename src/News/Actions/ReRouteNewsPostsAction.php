<?php

declare(strict_types=1);

namespace Made\Cms\News\Actions;

use Lorisleiva\Actions\Concerns\AsAction;
use Made\Cms\News\Models\Post;

class ReRouteNewsPostsAction
{
    use AsAction;

    public function handle(): void
    {
        Post::query()
            ->with('route')
            ->get()
            ->each(
                function (Post $post): void {
                    if (empty($post->route)) {
                        $post->route()->create([
                            'route' => '/' . implode('/', $post->urlSchema()),
                        ]);
                    } else {
                        $post->route->update([
                            'route' => '/' . implode('/', $post->urlSchema()),
                        ]);
                    }
                }
            );
    }
}
