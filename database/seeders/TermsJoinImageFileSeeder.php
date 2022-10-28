<?php

namespace Database\Seeders;

use App\Models\TermsJoinImageFile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TermsJoinImageFileSeeder extends Seeder
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
                "image_file_id" => rand(1, $count),
            ];
        }
        DB::table("terms_join_image_files")->insert($data);
    }
}
