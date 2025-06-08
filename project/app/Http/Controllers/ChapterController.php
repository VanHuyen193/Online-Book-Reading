<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Chapter;
use App\Models\Book;

class ChapterController extends Controller
{
    // Xem chapter trước/sau
    public function viewChapter($bookId, $chapterId)
    {
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
        
        $bookTitle = Book::findOrFail($bookId)->title;

        return view('Chapter', [
            'chapter' => $chapter,
            'previousChapter' => $previousChapter,
            'nextChapter' => $nextChapter,
            'bookId' => $bookId,
            'bookTitle' => $bookTitle,
        ]);
    }

    public function edit(Book $book, Chapter $chapter)
    {
        // Optionally check if chapter belongs to book
        if ($chapter->book_id !== $book->id) {
            abort(404);
        }

        return view('chapters.edit', compact('book', 'chapter'));
    }

    public function update(Request $request, Book $book, Chapter $chapter)
    {
        if ($chapter->book_id !== $book->id) {
            abort(404); // Bảo vệ dữ liệu
        }

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
        ]);

        $chapter->update($validated);

        return redirect()->route('books.edit', $book->id)->with('success', 'Chapter updated successfully!');
    }

    public function create(Request $request)
    {
        $bookId = $request->query('book_id');
        $insertAfterId = $request->query('insert_after');

        $book = Book::findOrFail($bookId);

        return view('chapters.create', compact('book', 'insertAfterId'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'book_id' => 'required|exists:books,id',
            'insert_after' => 'nullable|exists:chapters,id',
        ]);

        $book = Book::findOrFail($validated['book_id']);
        $chapters = $book->chapters()->orderBy('id')->get();
        $newChapters = [];
        $newChapterData = [
            'title' => $validated['title'],
            'content' => $validated['content'],
            'book_id' => $book->id,
        ];

        $inserted = false;

        foreach ($chapters as $chapter) {
            $newChapters[] = $chapter->toArray();
            if (!$inserted && $validated['insert_after'] == $chapter->id) {
                $newChapters[] = $newChapterData;
                $inserted = true;
            }
        }

        if (!$inserted) {
            $newChapters[] = $newChapterData;
        }

        $book->chapters()->delete();
        $book->chapters()->createMany($newChapters);

        return redirect()->route('books.edit', $book->id)->with('success', 'Chapter added successfully!');
    }



    public function deleteChapter(Book $book, Chapter $chapter)
    {
        if ($chapter->book_id !== $book->id) {
            abort(404);
        }
        $chapter->delete();

        return redirect()->route('books.edit', $book->id)
            ->with('success', 'Chapter deleted successfully!');
    }
}
