<?php

namespace Database\Factories;

use App\Models\Terms;
use Illuminate\Database\Eloquent\Factories\Factory;

class TermsFactory extends Factory
{
    protected $model = Terms::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'keyword_latin' => $this->faker->name(),
            'keyword_ru' => $this->faker->name(),
            'keyword_uz' => $this->faker->name(),
            'description_uz' => $this->faker->text($maxNbChars = 200),
            'description_ru' => $this->faker->text($maxNbChars = 200),
        ];
    }
}
