<?php

namespace Database\Factories;

use App\Models\ObjectFile;
use Illuminate\Database\Eloquent\Factories\Factory;

class ObjectFileFactory extends Factory
{
    protected $model = ObjectFile::class;
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
            'image' => $this->faker->image(),

        ];
    }
}
