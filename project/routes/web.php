<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Book;
use App\Models\Chapter;
use App\Http\Controllers\BookController;

Route::get('/', function () {
    return view('Home');
});

Route::get('/contact', function(){
    return view('Contact');
});

Route::resource('books', BookController::class);

Route::get('/books/{bookId}/chapters/{chapterId}', function ($bookId, $chapterId) {
    $chapter = Chapter::find($chapterId);
    return view('Chapter', ['chapter' => $chapter]);
});

