<?php

namespace Database\Factories;

use App\Models\ImageFile;
use App\Models\Lesson;
use Illuminate\Database\Eloquent\Factories\Factory;

class LessonJoinTermFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'lesson_id' => Lesson::all()->random()->id,
            'image_file_id' => ImageFile::all()->random()->id,
        ];
    }
}
