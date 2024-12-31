<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\ChapterController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/story/{story_id}/chapter/create', [ChapterController::class, 'create'])->name('chapters.create');


Route::get('/user{id}', [UserController::class, 'getUser']);

Route::get('/', [StoryController::class, 'index'])->name('home');
Route::get('/story/{id}', [StoryController::class, 'show'])->name('story.show');

Route::get('/chapter/{id}', [ChapterController::class, 'show'])->name('chapter.show');
// Route::get('/chapter/create', [ChapterController::class, 'create'])->name('chapters.create');
Route::post('/chapter', [ChapterController::class, 'store'])->name('chapters.store');
Route::get('/chapter/{id}/edit', [ChapterController::class, 'edit'])->name('chapters.edit');
Route::put('/chapter/{id}', [ChapterController::class, 'update'])->name('chapters.update');
Route::delete('/chapter/{id}', [ChapterController::class, 'destroy'])->name('chapters.destroy');

Route::get('/story/{story_id}/chapter/create', [ChapterController::class, 'create'])->name('chapters.create');


