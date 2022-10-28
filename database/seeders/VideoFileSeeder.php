<?php

namespace Database\Seeders;

use App\Models\VideoFile;
use Illuminate\Database\Seeder;

class VideoFileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VideoFile::factory()->count(10)->create();
    }
}
