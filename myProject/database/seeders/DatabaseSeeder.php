<?php

namespace Database\Seeders;

use App\Models\Chapter;
use App\Models\User;
use App\Models\Story;
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

        User::factory()->create([
            'name' => 'Test User 2',
            'email' => 'test2@example.com',
        ]);

        Story::create([
            'title' => 'Truyện 1', 
            'description' => 'Mô tả truyện 1', 
            'author' => 'Tác giả 1']);
        Story::create([
            'title' => 'Truyện 2', 
            'description' => 'Mô tả truyện 2', 
            'author' => 'Tác giả 2']);

        Chapter::create([
            'story_id' => 1,
            'title' => 'Chương 1',
            'content' => 'Nội dung chương 1',
        ]);
        Chapter::create([
            'story_id' => 1,
            'title' => 'Chương 2',
            'content' => 'Nội dung chương 2',
        ]);
        Chapter::create([
            'story_id' => 2,
            'title' => 'Chương 1',
            'content' => 'Nội dung chương 1',
        ]);
        Chapter::create([
            'story_id' => 2,
            'title' => 'Chương 2',
            'content' => 'Nội dung chương 2',
        ]);
    }
}
