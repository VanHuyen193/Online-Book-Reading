<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chapter;

class ChapterController extends Controller
{
    // Xem chapter trước/sau
    public function viewChapter ($bookId, $chapterId) {
        $chapter = Chapter::findOrFail($chapterId);

        // Lấy chương trước (nếu có)
        $previousChapter = Chapter::where('book_id', $bookId)
            ->where('id', '<', $chapterId)
            ->orderBy('id', 'desc')
            ->first();

        // Lấy chương sau (nếu có)
        $nextChapter = Chapter::where('book_id', $bookId)
            ->where('id', '>', $chapterId)
            ->orderBy('id', 'asc')
            ->first();

        return view('Chapter', [
            'chapter' => $chapter,
            'previousChapter' => $previousChapter,
            'nextChapter' => $nextChapter,
            'bookId' => $bookId,
        ]);
    }
}
