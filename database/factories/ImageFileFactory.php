<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name_ru' => $this->faker->name(),
            'name_uz' => $this->faker->name(),
            'url' => $this->faker->url(),
        ];
    }
}
