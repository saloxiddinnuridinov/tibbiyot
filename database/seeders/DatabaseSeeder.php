<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([ 
            UserSeeder::class,
            StudentSeeder::class,
            CategorySeeder::class,
            ContentSeeder::class,
            LessonSeeder::class,
            TermsSeeder::class,
            ObjectFileSeeder::class,
            VideoFileSeeder::class,
            ImageFileSeeder::class,
            LessonJoinObjectFileSeeder::class,
            LessonJoinVideoFileSeeder::class,
            LessonJoinImageFileSeeder::class,
            LessonJoinTermsSeeder::class,
            TermsJoinObjectFileSeeder::class,
            TermsJoinVideoFileSeeder::class,
            TermsJoinImageFileSeeder::class,
       ]);
        
    }
}
