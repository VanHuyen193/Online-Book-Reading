<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Book;
use App\Models\Chapter;
use App\Http\Controllers\BookController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\EnsureUserIsAdmin;

Route::get('/', function () {return view('Home');});

Route::get('/contact', function(){return view('Contact');});

// Route::get('/savedbooks', function(){return view('user.savedbook');});
Route::post('/books/{book}/save', [BookController::class, 'saveBook']);
Route::get('/savedbooks', [BookController::class, 'showSavedBook']);
Route::delete('/savedbooks/{savedbook}', [BookController::class, 'deleteSavedBook'])->name('savedbooks.delete');

Route::resource('books', BookController::class);

Route::get('/books/{bookId}/chapters/{chapterId}', [BookController::class, 'viewChapter']);

// Auth
Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create']);
Route::post('/login', [SessionController::class, 'store']);

Route::post('/logout', [SessionController::class, 'destroy']);

Route::middleware(EnsureUserIsAdmin::class, 'auth')->group(function () {
    Route::get('/admin', function(){return view('admin.index');});
    Route::get('/admin/books', function(){
        $books = Book::paginate(5);
        return view('admin.bookS', [
            'books' => $books->withPath('https://laughing-space-bassoon-4x6gv6xgjrp2j9gq-8000.app.github.dev/admin/books')
    ]);});
    Route::get('/books/create', [BookController::class, 'create']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::put('/profile/update', [ProfileController::class, 'update']);
    Route::delete('/profile/delete', [ProfileController::class, 'destroy']);
});

Route::get('/hello', function(){
    $user = Auth::user();
    dd($user); 
});