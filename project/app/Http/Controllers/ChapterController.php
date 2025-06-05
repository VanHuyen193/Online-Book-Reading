<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chapter;
use App\Models\Book;

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

        // ✅ FIX: Đảm bảo không so sánh với null
        if (!empty($validated['insert_after'])) {
            $afterChapter = Chapter::find($validated['insert_after']);

            // ✅ FIX: Kiểm tra nếu $afterChapter tồn tại và order hợp lệ
            if ($afterChapter && $afterChapter->order !== null) {
                // ✅ FIX: Dời các chương có order >= vị trí mới
                Chapter::where('book_id', $book->id)
                    ->where('order', '>=', $afterChapter->order + 1)
                    ->increment('order');

                $order = $afterChapter->order + 1;
            } else {
                // ✅ FIX: Nếu order bị null thì fallback thêm cuối
                $maxOrder = $book->chapters()->max('order');
                $order = $maxOrder !== null ? $maxOrder + 1 : 1;
            }
        } else {
            // ✅ FIX: Fallback nếu thêm cuối
            $maxOrder = $book->chapters()->max('order');
            $order = $maxOrder !== null ? $maxOrder + 1 : 1;
        }

        $book->chapters()->create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'order' => $order,
        ]);

        return redirect()->route('books.edit', $book->id)->with('success', 'Chapter added successfully!');
    }






}
