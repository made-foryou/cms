<?php

declare(strict_types=1);

namespace Made\Cms\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Made\Cms\Website\Models\MenuItem;

class MenuItemFactory extends Factory
{
    protected $model = MenuItem::class;

    public function definition(): array
    {
        return [
            'location' => $this->faker->word(),
            'link' => $this->faker->url(),
            'label' => $this->faker->word(),
            'title' => $this->faker->sentence(),
        ];
    }
}
