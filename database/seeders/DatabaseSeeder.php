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
            TermSeeder::class,
            ObjectFileSeeder::class,
            VideoFileSeeder::class,
            ImageFileSeeder::class,
            LessonJoinObjectFileSeeder::class,
            LessonJoinVideoFileSeeder::class,
            LessonJoinImageFileSeeder::class,
            LessonJoinTermSeeder::class,
            TermJoinObjectFileSeeder::class,
            TermJoinVideoFileSeeder::class,
            TermJoinImageFileSeeder::class,
       ]);
        
    }
}
