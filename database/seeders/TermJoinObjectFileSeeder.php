<?php

namespace Database\Seeders;

use App\Models\TermJoinObjectFile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TermJoinObjectFileSeeder extends Seeder
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
                "object_file_id" => rand(1, $count),
            ];
        }
        DB::table("term_join_object_files")->insert($data);
    }
}
