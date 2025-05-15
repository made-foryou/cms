<?php

namespace Made\Cms\Tests\Unit\News\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Made\Cms\Facades\Made;
use Made\Cms\News\Models\Post;
use Made\Cms\News\Models\Settings\NewsSettings;
use Made\Cms\Page\Models\Page;
use Made\Cms\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class PostTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_adds_the_news_page_to_the_route(): void
    {
        $page = Page::factory()
            ->create();

        NewsSettings::fake([
            'news_page' => Made::LINK_TYPE_PAGES . ":{$page->id}",
        ]);

        $post = Post::factory()
            ->create();

        $this->assertStringContainsString(
            '/' . implode('/', $page->urlSchema()),
            '/' . implode('/', $post->urlSchema()),
        );
    }
}
