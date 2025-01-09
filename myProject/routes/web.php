<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\ChapterController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\StoryAdminController;
use App\Http\Controllers\Admin\ChapterAdminController;

// Đảm bảo user đã đăng nhập và phân quyền admin
// Route::middleware(['admin'])->prefix('admin')->group(function () {
//     Route::resource('stories', StoryAdminController::class);
//     Route::resource('chapters', ChapterAdminController::class)->except(['index', 'show']);
// });

// Routes cho các truyện và chương truyện
Route::get('/', [StoryController::class, 'index'])->name('stories.index');
Route::get('/story/{id}', [StoryController::class, 'show'])->name('stories.show');
Route::get('/story/{storyId}/chapter/{chapterId}', [ChapterController::class, 'show'])->name('chapters.show');

// Routes admin (chỉ cho admin truy cập)
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::resource('stories', StoryAdminController::class)->except(['show']);
    Route::resource('chapters', ChapterAdminController::class)->except(['index', 'show']);
});


Auth::routes(); // Đăng nhập/đăng ký cho người dùng
