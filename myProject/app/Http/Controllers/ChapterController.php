<?php

namespace App\Http\Controllers;

use App\Models\Story;
use App\Models\Chapter;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    public function show($storyId, $chapterId)
    {
        // Lấy truyện và chương
        $story = Story::findOrFail($storyId);
        $chapter = Chapter::where('story_id', $storyId)->findOrFail($chapterId);

        // Lấy chương trước và sau
        $previousChapter = Chapter::where('story_id', $storyId)
            ->where('chapter_number', '<', $chapter->chapter_number)
            ->orderBy('chapter_number', 'desc')
            ->first();

        $nextChapter = Chapter::where('story_id', $storyId)
            ->where('chapter_number', '>', $chapter->chapter_number)
            ->orderBy('chapter_number', 'asc')
            ->first();

        return view('chapters.show', compact('story', 'chapter', 'previousChapter', 'nextChapter'));
    }
}

