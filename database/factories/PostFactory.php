<?php

namespace Made\Cms\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Made\Cms\Language\Models\Language;
use Made\Cms\Models\User;
use Made\Cms\News\Models\Post;
use Made\Cms\Shared\Enums\PublishingStatus;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        $name = $this->faker->sentence();

        return [
            'language_id' => Language::factory(),
            'name' => $name,
            'slug' => \Str::slug($name),
            'date' => $this->faker->date(),
            'created_by' => User::factory(),
        ];
    }

    public function draft(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => PublishingStatus::Draft->value,
            ];
        });
    }

    public function published(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => PublishingStatus::Published->value,
            ];
        });
    }
}
