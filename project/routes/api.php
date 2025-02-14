<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API;

Route::get('/users', [API::class, 'users']);
Route::get('/books/{bookId}/chapters/{chapterId}', [API::class, 'viewChapter']);
Route::post('/users', [API::class, 'addUser']);

