<?php

namespace Database\Seeders;

use App\Models\LessonJoinObjectFile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LessonJoinObjectFileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 5;
        $data = [];
        $one = 1;
        for ($i=1; $i<$count; $i++){
            $data[] = [
                "lesson_id" => $one++,
                "object_file_id" => rand(1, $count),
            ];
        }
        DB::table("lesson_join_object_files")->insert($data);
    }
}
