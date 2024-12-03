<?php

namespace Made\Cms\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Made\Cms\Enums\PageStatus;
use Made\Cms\Models\Page;
use Made\Cms\Models\User;

class PageFactory extends Factory
{
    protected $model = Page::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'slug' => $this->faker->slug(),
            'status' => PageStatus::Draft->value,
            'content' => $this->faker->paragraphs(3, true),
            'author_id' => fn () => User::factory()->createOne()->id,
        ];
    }
}
