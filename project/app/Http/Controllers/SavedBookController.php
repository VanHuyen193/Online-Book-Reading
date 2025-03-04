<?php

namespace App\Http\Controllers;
use App\Models\SavedBook;
use Illuminate\Http\Request;

class SavedBookController extends Controller
{
    public function saveBook(Request $request, $bookId)
    {
        if (!auth()->check()) {
            return redirect(url('/books/' . $bookId))->with('error', 'You need to log in to save books.');
        }

        $userId = auth()->id();

        // Kiểm tra nếu sách đã được lưu trước đó
        $existingSavedBook = SavedBook::where('user_id', $userId)
            ->where('book_id', $bookId)
            ->first();

        if ($existingSavedBook) {
            return redirect(url('/books/' . $bookId))->with('info', 'You have already saved this book.');
        }

        // Lưu sách vào danh sách đã lưu
        SavedBook::create([
            'user_id' => $userId,
            'book_id' => $bookId,
        ]);

        return redirect(url('/books'))->with('success', 'Book saved successfully!');
    }

    public function showSavedBook()
    {
        if (!auth()->check()) {
            return view('user.savedbook', [
                'message' => 'You need to log in to view saved books.',
                'savedBooks' => collect() 
            ]);
        }

        $userId = auth()->id();
        $savedBooks = SavedBook::with('book')->where('user_id', $userId)->get();

        if ($savedBooks->isEmpty()) {
            return view('user.savedbook', [
                'message' => 'You have not saved any books yet',
                'savedBooks' => collect() 
            ]);
        }

        return view('user.savedbook', ['savedBooks' => $savedBooks]);
    }

    public function deleteSavedBook(SavedBook $savedbook){
        $savedbook->delete();
        return redirect(url('/savedbooks'))->with('success', 'Book deleted successfully!');
    }
}
