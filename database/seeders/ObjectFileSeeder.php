<?php

namespace Database\Seeders;

use App\Models\ObjectFile;
use Illuminate\Database\Seeder;

class ObjectFileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ObjectFile::factory()->count(10)->create();
    }
}
