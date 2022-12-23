<?php

namespace Database\Factories;

use App\Models\ImageFile;
use App\Models\Term;
use App\Models\TermJoinImageFile;
use Illuminate\Database\Eloquent\Factories\Factory;

class TermJoinImageFileFactory extends Factory
{
    protected $model = TermJoinImageFile::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'term_id' => Term::all()->random()->id,
            'image_file_id' => ImageFile::all()->random()->id,
        ];
    }
}
