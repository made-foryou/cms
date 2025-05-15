<?php

namespace Made\Cms\Tests\Feature\News;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Made\Cms\Made;
use Made\Cms\News\Models\Post;
use Made\Cms\News\Models\Settings\NewsSettings;
use Made\Cms\Page\Models\Page;
use Made\Cms\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class ReRouteTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_re_routes_the_posts_when_the_news_page_gets_changed(): void
    {
        $pages = Page::factory()
            ->count(6)
            ->create();

        $selected = $pages->random(2);

        NewsSettings::fake([
            'news_page' => Made::LINK_TYPE_PAGES . ":{$selected->first()->id}",
        ], false);

        $posts = Post::factory()
            ->count(random_int(1, 5))
            ->create();

        $posts->load('route');

        $posts->each(function (Post $post) use ($selected) {
            $this->assertStringContainsString(
                '/' . implode('/', $selected->first()->urlSchema()),
                '/' . implode('/', $post->urlSchema())
            );
        });

        $settings = app()->make(NewsSettings::class);
        $settings->news_page = Made::LINK_TYPE_PAGES . ":{$selected->skip(1)->first()->id}";
        $settings->save();

        $posts->each(function (Post $post) use ($selected) {
            $post->refresh();

            $this->assertStringContainsString(
                '/' . implode('/', $selected->skip(1)->first()->urlSchema()),
                '/' . implode('/', $post->urlSchema())
            );
        });

    }
}
