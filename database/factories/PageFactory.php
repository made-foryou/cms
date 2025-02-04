<?php

namespace Made\Cms\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Made\Cms\Language\Models\Language;
use Made\Cms\Models\User;
use Made\Cms\Page\Models\Page;
use Made\Cms\Shared\Enums\PublishingStatus;

class PageFactory extends Factory
{
    protected $model = Page::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'slug' => $this->faker->slug(),
            'language_id' => Language::factory(),
            'status' => PublishingStatus::Draft->value,
            'content' => $this->faker->paragraphs(3, true),
            'created_by' => User::factory(),
        ];
    }
}
