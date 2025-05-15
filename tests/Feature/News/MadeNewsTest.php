<?php

namespace Made\Cms\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Made\Cms\News\Facades\MadeNews;
use Made\Cms\News\Models\Post;
use Made\Cms\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class MadeNewsTest extends TestCase
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

        $count = random_int(1, 8);

        Post::factory()
            ->count($count)
            ->published()
            ->create();

        $results = MadeNews::news();

        $this->assertInstanceOf(
            \Illuminate\Database\Eloquent\Collection::class,
            $results
        );

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
}
