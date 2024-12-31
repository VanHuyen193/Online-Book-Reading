<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/user{id}', [UserController::class, 'getUser']);

Route::get('/book',[BookController::class, 'index'] )->name('book');