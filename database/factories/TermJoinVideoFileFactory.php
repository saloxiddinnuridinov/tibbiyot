<?php

namespace Database\Factories;

use App\Models\Term;
use App\Models\TermJoinVideoFile;
use App\Models\VideoFile;
use Illuminate\Database\Eloquent\Factories\Factory;

class TermJoinVideoFileFactory extends Factory
{
    protected $model = TermJoinVideoFile::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'term_id' => Term::all()->random()->id,
            'video_file_id' => VideoFile::all()->random()->id,
        ];
    }
}
