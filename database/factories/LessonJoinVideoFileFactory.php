<?php

namespace Database\Factories;

use App\Models\Lesson;
use App\Models\LessonJoinVideoFile;
use App\Models\VideoFile;
use Illuminate\Database\Eloquent\Factories\Factory;

class LessonJoinVideoFileFactory extends Factory
{
    protected $model = LessonJoinVideoFile::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'lesson_id' => Lesson::all()->random()->id,
            'video_file_id' => VideoFile::all()->random()->id,
        ];
    }
}
