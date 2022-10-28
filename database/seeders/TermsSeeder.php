<?php

namespace Database\Seeders;

use App\Models\Terms;
use Illuminate\Database\Seeder;

class TermsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Terms::factory()->count(10)->create();
    }
}
