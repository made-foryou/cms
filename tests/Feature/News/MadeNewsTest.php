<?php

namespace Made\Cms\Tests\Feature\News;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Made\Cms\News\Facades\MadeNews;
use Made\Cms\News\Models\Post;
use Made\Cms\News\QueryBuilders\PostQueryBuilder;
use Made\Cms\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class MadeNewsTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_return_news_posts_for_an_overview(): void
    {
        $this->assertInstanceOf(
            PostQueryBuilder::class,
            MadeNews::news()
        );

        $this->assertCount(0, MadeNews::news()->get());

        $count = random_int(1, 8);

        Post::factory()
            ->count($count)
            ->published()
            ->create();

        $results = MadeNews::news();

        $this->assertInstanceOf(
            PostQueryBuilder::class,
            $results
        );

        $results = $results->get();

        $this->assertCount($count, $results);

        $this->assertInstanceOf(
            Post::class,
            $results->first()
        );

        $sortedByDate = $results->sortByDesc('date');

        $same = true;
        for ($i = 0; $i < $sortedByDate->count(); $i++) {
            if ($results->pluck('id')->get($i) !== $sortedByDate->pluck('id')->get($i)) {
                $same = false;
            }
        }

        $this->assertTrue($same);
    }

    #[Test]
    public function it_can_return_the_next_posts(): void
    {
        $post = Post::factory()
            ->published()
            ->create();

        $posts = MadeNews::nextPosts($post);

        $this->assertInstanceOf(
            Collection::class,
            $posts,
        );

        $this->assertCount(0, $posts);

        Post::factory()
            ->count(3)
            ->published()
            ->create();

        $posts = MadeNews::nextPosts($post);

        $this->assertCount(3, $posts);

        $this->assertInstanceOf(
            Post::class,
            $posts->first()
        );
    }
}
