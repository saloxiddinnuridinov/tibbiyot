<?php

namespace Database\Factories;

use App\Models\ObjectFile;
use App\Models\Terms;
use App\Models\TermsJoinObjectFile;
use Illuminate\Database\Eloquent\Factories\Factory;

class TermsJoinObjectFileFactory extends Factory
{
    protected $model = TermsJoinObjectFile::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'term_id' => Terms::all()->random()->id,
            'object_file_id' => ObjectFile::all()->random()->id,
        ];
    }
}
