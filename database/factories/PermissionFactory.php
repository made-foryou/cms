<?php

namespace Made\Cms\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Made\Cms\Models\Permission;

class PermissionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<Permission>
     */
    protected $model = Permission::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'key' => $this->faker->word(),
            'subject' => self::class,
            'name' => $this->faker->jobTitle(),
            'description' => $this->faker->sentence(3, false),
        ];
    }
}
