<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Story;
use App\Models\Chapter;

class ChapterSeeder extends Seeder
{
    public function run()
    {
        $stories = Story::all();

        foreach ($stories as $story) {
            for ($i = 1; $i <= 10; $i++) {
                Chapter::create([
                    'story_id' => $story->id,
                    'title' => "Chương $i",
                    'content' => "Nội dung chương $i của truyện {$story->title}. Đây là nội dung giả lập để kiểm tra.",
                    'chapter_number' => $i,
                ]);
            }
        }
    }
}

