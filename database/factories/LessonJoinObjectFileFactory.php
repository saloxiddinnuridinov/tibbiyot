<?php

namespace Database\Factories;

use App\Models\Lesson;
use App\Models\ObjectFile;
use Illuminate\Database\Eloquent\Factories\Factory;

class LessonJoinObjectFileFactory extends Factory
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
            'object_file_id' => ObjectFile::all()->random()->id,
        ];
    }
}
