<?php

namespace Database\Factories;

use App\Models\Terms;
use App\Models\TermsJoinVideoFile;
use App\Models\VideoFile;
use Illuminate\Database\Eloquent\Factories\Factory;

class TermsJoinVideoFileFactory extends Factory
{
    protected $model = TermsJoinVideoFile::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'term_id' => Terms::all()->random()->id,
            'video_file_id' => VideoFile::all()->random()->id,
        ];
    }
}
