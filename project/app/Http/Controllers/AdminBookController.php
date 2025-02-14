<?php

namespace App\Http\Controllers;
use App\Models\Book;
use Illuminate\Http\Request;

class AdminBookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::query();

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $books = $query->paginate(5);
        return view('admin.bookS', [
            'books' => $books->withPath('https://laughing-space-bassoon-4x6gv6xgjrp2j9gq-8000.app.github.dev/admin/books')
        ]);
    }
}
