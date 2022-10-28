<?php

namespace Database\Seeders;

use App\Models\LessonJoinTerms;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LessonJoinTermsSeeder extends Seeder
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
                "term_id" => rand(1, $count),
            ];
        }
        DB::table("lesson_join_terms")->insert($data);
    }
}
