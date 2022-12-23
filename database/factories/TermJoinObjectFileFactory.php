<?php

namespace Database\Factories;

use App\Models\ObjectFile;
use App\Models\Term;
use App\Models\TermJoinObjectFile;
use Illuminate\Database\Eloquent\Factories\Factory;

class TermJoinObjectFileFactory extends Factory
{
    protected $model = TermJoinObjectFile::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'term_id' => Term::all()->random()->id,
            'object_file_id' => ObjectFile::all()->random()->id,
        ];
    }
}
