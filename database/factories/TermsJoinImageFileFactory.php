<?php

namespace Database\Factories;

use App\Models\ImageFile;
use App\Models\Terms;
use App\Models\TermsJoinImageFile;
use Illuminate\Database\Eloquent\Factories\Factory;

class TermsJoinImageFileFactory extends Factory
{
    protected $model = TermsJoinImageFile::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'term_id' => Terms::all()->random()->id,
            'image_file_id' => ImageFile::all()->random()->id,
        ];
    }
}
