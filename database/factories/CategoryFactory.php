<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name_uz' => $this->faker->name(),
            'name_ru' => $this->faker->name(),
            'image' => $this->faker->lastName(),
            'parent_id' => $this->faker->numberBetween(0, 9)
        ];
    }
}
