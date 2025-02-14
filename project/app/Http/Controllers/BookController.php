<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\Chapter;
use App\Models\SavedBook;
use Illuminate\Http\Request;

class BookController extends Controller
{
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
}

