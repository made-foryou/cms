<?php

namespace Made\Cms\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Made\Cms\Models\Page;
use Made\Cms\Models\User;
use Made\Cms\Shared\Enums\PublishingStatus;

class PageFactory extends Factory
{
    protected $model = Page::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'slug' => $this->faker->slug(),
            'status' => PublishingStatus::Draft->value,
            'content' => $this->faker->paragraphs(3, true),
            'author_id' => User::factory(),
        ];
    }
}
