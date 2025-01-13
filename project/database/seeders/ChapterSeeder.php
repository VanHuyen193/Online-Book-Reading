<?php

namespace Database\Seeders;

use App\Models\Chapter;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChapterSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Chapter::factory(10)->create();

    }
}
