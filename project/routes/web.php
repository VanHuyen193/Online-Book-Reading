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
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\SavedBookController;
use App\Http\Controllers\AdminBookController;
use App\Http\Middleware\EnsureUserIsAdmin;

// Public routes
Route::view('/', 'Home');
Route::view('/contact', 'Contact');

// Book Routes
Route::resource('books', BookController::class);
Route::get('/books/{book}/chapters/{chapter}', [ChapterController::class, 'viewChapter'])->name('chapters.view');


// Saved Books
Route::prefix('savedbooks')->group(function () {
    Route::post('/{book}/save', [SavedBookController::class, 'saveBook'])->name('savedbooks.save');
    Route::get('/', [SavedBookController::class, 'showSavedBook'])->name('savedbooks.index');
    Route::delete('/{savedbook}', [SavedBookController::class, 'deleteSavedBook'])->name('savedbooks.delete');
});


// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store']);
});
Route::post('/logout', [SessionController::class, 'destroy'])->middleware('auth')->name('logout');

// Admin Routes
Route::middleware(EnsureUserIsAdmin::class, 'auth')->group(function () {
    Route::get('/admin', function(){return view('admin.index');});
    Route::get('/admin/books', [AdminBookController::class, 'index']);
    Route::get('/books/create', [BookController::class, 'create']);
});

// User Profile Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::put('/profile/update', [ProfileController::class, 'update']);
    Route::delete('/profile/delete', [ProfileController::class, 'destroy']);
});

Route::get('/hello', function(){
    $user = Auth::user();
    dd($user); 
});