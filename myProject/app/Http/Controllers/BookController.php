<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    // Tạo controller: php artisan make:controller name
    public function index(){
        $books = Book::all();
        return view('Book', compact('books'));
    }
}
