<?php

namespace Made\Cms\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Made\Cms\News\Facades\MadeNews;
use Made\Cms\News\Models\Post;
use Made\Cms\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class MadeCmsTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_return_news_posts_for_an_overview(): void
    {
        $this->assertInstanceOf(
            \Illuminate\Database\Eloquent\Collection::class,
            MadeNews::news()
        );

        $this->assertCount(0, MadeNews::news());

        $posts = Post::factory()
            ->count(5)
            ->published()
            ->create();

        $this->assertInstanceOf(
            \Illuminate\Database\Eloquent\Collection::class,
            MadeNews::news()
        );

        $this->assertCount(5, MadeNews::news());

        $this->assertInstanceOf(
            Post::class,
            MadeNews::news()->first()
        );
    }
}
