<?php

namespace Database\Seeders;

use App\Models\story;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        story::create([
            'Name' => 'Test book',
            'BookCode' => 'abcd',
        ]);

        story::create([
            'Name' => 'Test book2',
            'BookCode' => 'abcd2',
        ]);
    }
}
