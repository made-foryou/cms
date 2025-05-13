<?php

namespace Made\Cms\Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Made\Cms\Facades\Cms;
use Made\Cms\Page\Models\Page;
use Made\Cms\Tests\TestCase;
use Made\Cms\Website\Models\MenuItem;
use Made\Cms\Website\Models\Settings\WebsiteSetting;
use PHPUnit\Framework\Attributes\Test;

class CmsTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    #[Test]
    public function it_generates_an_url_from_a_route(): void
    {
        $page = Page::factory()->create();
        $page->refresh();

        $this->assertSame(url($page->route->route), Cms::url($page->route));
    }

    #[Test]
    public function it_generates_an_url_from_a_routeable_model(): void
    {
        $page = Page::factory()->create();
        $page->refresh();

        $this->assertSame(url($page->route->route), Cms::url($page));
    }

    #[Test]
    public function it_generates_an_empty_url_when_the_given_model_is_the_landing_page(): void
    {
        $page = Page::factory()->create();
        $page->refresh();

        $websiteSetting = new WebsiteSetting;
        $websiteSetting->landing_page = 'page:' . $page->id;
        $websiteSetting->save();

        $this->assertSame(url('/'), Cms::url($page));
    }

    #[Test]
    public function it_can_return_the_menu_items_of_a_menu_location(): void
    {
        $randomInt = random_int(0, 8);

        for ($i = 0; $i < $randomInt; $i++) {
            MenuItem::factory()
                ->for(Page::factory(), 'linkable')
                ->create([
                    'location' => 'main',
                ]);
        }

        $items = Cms::navigationItems('main');

        $this->assertSame($randomInt, $items->count());

        $menuItem = MenuItem::inRandomOrder()->first();

        MenuItem::factory()
            ->for(Page::factory(), 'linkable')
            ->create([
                'location' => 'main',
                'parent_id' => $menuItem->id,
            ]);

        $items = Cms::navigationItems('main');

        $selectedItem = $items->filter(fn ($item) => $item->id === $menuItem->id)->first();

        $this->assertSame($randomInt, $items->count());
        $this->assertSame(1, $selectedItem->children->count());
    }
}
