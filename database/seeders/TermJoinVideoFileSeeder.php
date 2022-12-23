<?php

namespace Database\Seeders;

use App\Models\TermJoinVideoFile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TermJoinVideoFileSeeder extends Seeder
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
                "term_id" => $one++,
                "video_file_id" => rand(1, $count),
            ];
        }
        DB::table("term_join_video_files")->insert($data);
    }
}
