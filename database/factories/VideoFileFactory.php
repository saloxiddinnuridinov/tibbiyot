<?php

namespace Database\Factories;

use App\Models\VideoFile;
use Illuminate\Database\Eloquent\Factories\Factory;

class VideoFileFactory extends Factory
{
    protected $model = VideoFile::class;
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
