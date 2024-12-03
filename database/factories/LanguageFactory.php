<?php

namespace Made\Cms\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Made\Cms\Language\Models\Language;

class LanguageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<Language>
     */
    protected $model = Language::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'locale' => $this->faker->word(),
            'abbreviation' => $this->faker->word(),
        ];
    }

    /**
     * The default method.
     *
     * This method returns an instance of the Factory class.
     * It sets the is_default attribute to true using the state method.
     *
     * @return Factory The instance of the Factory class
     */
    public function default(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'is_default' => true,
            ];
        });
    }
}
