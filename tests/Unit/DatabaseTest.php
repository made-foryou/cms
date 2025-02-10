<?php

namespace Made\Cms\Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Made\Cms\Models\User;
use Made\Cms\Tests\TestCase;

class DatabaseTest extends TestCase
{
    use RefreshDatabase;

    public function test_basic()
    {
        $user = User::factory()->create();

        $this->assertTrue(true);

        $this->assertDatabaseHas('made_cms_users', ['name' => $user->name]);
    }
}
