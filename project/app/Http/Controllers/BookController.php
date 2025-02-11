<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\Chapter;
use App\Models\SavedBook;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // public function __construct()
    // {

    //     $this->middleware('admin')->only(['create', 'edit']);
    // }

    // Display a listing of the books
    public function index(Request $request)
    {
        $query = Book::query();

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $books = $query->paginate(5);
        return view('book.index', [
            'books' => $books->withPath('https://laughing-space-bassoon-4x6gv6xgjrp2j9gq-8000.app.github.dev/books')
        ]);
    }

    // Show the form for creating a new book
    public function create()
    {
        return view('book.create');
    }

    // Display the specified book
    public function show(Book $book)
    {
        $book->load('chapters');
        return view('book.show', ['book' => $book]);
    }

    // Store a newly created book in storage
    public function store()
    {
        $validated = request()->validate([
            'book-title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'chapter-title' => ['array', 'required'],
            'chapter-title.*' => ['required', 'string', 'max:255'],
            'chapter-content' => ['array', 'required'],
            'chapter-content.*' => ['required', 'string'],
        ]);

        $book = Book::create([
            'title' => $validated['book-title'],
            'content' => $validated['description'],
        ]);

        $chapters = collect($validated['chapter-title'])->map(function ($title, $index) use ($validated) {
            return [
                'title' => $title,
                'content' => $validated['chapter-content'][$index],
            ];
        });

        $book->chapters()->createMany($chapters->toArray());

        return redirect('https://laughing-space-bassoon-4x6gv6xgjrp2j9gq-8000.app.github.dev/books/create')
        ->with('success', 'Book created successfully!');
    }

    // Show the form for editing the specified book
    public function edit(Book $book)
    {
        $chapters = $book->chapters;
        return view('book.edit', compact('book', 'chapters'));
    }

    // Update the specified book in storage
    public function update(Book $book)
    {
        $validated = request()->validate([
            'book-title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'chapter-title' => ['array', 'required'],
            'chapter-title.*' => ['required', 'string', 'max:255'],
            'chapter-content' => ['array', 'required'],
            'chapter-content.*' => ['required', 'string'],
        ]);

        $book->update([
            'title' => $validated['book-title'],
            'content' => $validated['description'],
        ]);

        $chapters = collect($validated['chapter-title'])->map(function ($title, $index) use ($validated) {
            return [
                'title' => $title,
                'content' => $validated['chapter-content'][$index],
            ];
        });

        $book->chapters()->delete();
        $book->chapters()->createMany($chapters->toArray());

        return redirect('https://laughing-space-bassoon-4x6gv6xgjrp2j9gq-8000.app.github.dev/books/' . $book->id)
         ->with('success', 'Book updated successfully!');

    }

    // Remove the specified book from storage
    public function destroy(Book $book)
    {
        $book->chapters()->delete();
        $book->delete();

        return redirect('https://laughing-space-bassoon-4x6gv6xgjrp2j9gq-8000.app.github.dev/admin/books')
        ->with('success', 'Book deleted successfully!');
    }

    public function saveBook(Request $request, $bookId)
    {
        if (!auth()->check()) {
            return redirect('https://laughing-space-bassoon-4x6gv6xgjrp2j9gq-8000.app.github.dev/books/' . $bookId)
                ->with('error', 'You need to log in to save books.');
        }

        $userId = auth()->id();

        // Kiểm tra nếu sách đã được lưu trước đó
        $existingSavedBook = SavedBook::where('user_id', $userId)
            ->where('book_id', $bookId)
            ->first();

        if ($existingSavedBook) {
            return redirect('https://laughing-space-bassoon-4x6gv6xgjrp2j9gq-8000.app.github.dev/books/' . $bookId)
                ->with('info', 'You have already saved this book.');
        }

        // Lưu sách vào danh sách đã lưu
        SavedBook::create([
            'user_id' => $userId,
            'book_id' => $bookId,
        ]);

        return redirect('https://laughing-space-bassoon-4x6gv6xgjrp2j9gq-8000.app.github.dev/books')
            ->with('success', 'Book saved successfully!');
    }



    public function showSavedBook()
    {
        if (!auth()->check()) {
            return view('user.savedbook', [
                'message' => 'You need to log in to view saved books.',
                'savedBooks' => collect() // Truyền một Collection rỗng để tránh lỗi
            ]);
        }

        $userId = auth()->id();
        $savedBooks = SavedBook::with('book')->where('user_id', $userId)->get();

        if ($savedBooks->isEmpty()) {
            return view('user.savedbook', [
                'message' => 'You have not saved any books yet',
                'savedBooks' => collect() // Truyền một Collection rỗng
            ]);
        }

        return view('user.savedbook', ['savedBooks' => $savedBooks]);
    }


    public function deleteSavedBook(SavedBook $savedbook){
        $savedbook->delete();
        return redirect('https://laughing-space-bassoon-4x6gv6xgjrp2j9gq-8000.app.github.dev/savedbooks')
        ->with('success', 'Book deleted successfully!');
    }

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


// 'https://laughing-space-bassoon-4x6gv6xgjrp2j9gq-8000.app.github.dev/books/create'

