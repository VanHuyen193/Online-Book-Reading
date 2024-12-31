<?php

namespace App\Http\Controllers;

use App\Models\story;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(){
        $story = story::all();
        return view("book",compact("story"));
    }
}
