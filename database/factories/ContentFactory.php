<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title_uz' => $this->faker->name(),
            'title_ru' => $this->faker->name(),
            'body_uz' => $this->faker->text($maxNbChars = 200),
            'body_ru' => $this->faker->text($maxNbChars = 200),
        ];
    }
}
