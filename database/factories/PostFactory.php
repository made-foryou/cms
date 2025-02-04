<?php

namespace Made\Cms\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Made\Cms\Language\Models\Language;
use Made\Cms\Models\User;
use Made\Cms\News\Models\Post;

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
            'created_by' => User::factory(),
        ];
    }
}
