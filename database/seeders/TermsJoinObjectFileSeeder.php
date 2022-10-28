<?php

namespace Database\Seeders;

use App\Models\TermsJoinObjectFile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TermsJoinObjectFileSeeder extends Seeder
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
        DB::table("terms_join_object_files")->insert($data);
    }
}
