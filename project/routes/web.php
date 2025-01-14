<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Book;
use App\Models\Chapter;
use App\Http\Controllers\BookController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Middleware\EnsureUserIsAdmin;

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

// Auth
Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create']);
Route::post('/login', [SessionController::class, 'store']);

Route::post('/logout', [SessionController::class, 'destroy']);

// Route::get('/test', function(){return view('test');});

Route::middleware(EnsureUserIsAdmin::class, 'auth')->group(function () {
    Route::get('/books/create', [BookController::class, 'create']);
    Route::get('/books/edit/{id}', [BookController::class, 'edit']);
});