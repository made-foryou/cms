<?php

namespace Made\Cms\Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Made\Cms\Facades\Cms;
use Made\Cms\Page\Models\Page;
use Made\Cms\Tests\TestCase;
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

        $websiteSetting = new WebsiteSetting();

        $websiteSetting->landing_page = $page->id;
        $websiteSetting->save();
        
        $this->assertSame(url('/'), Cms::url($page));
    }
}