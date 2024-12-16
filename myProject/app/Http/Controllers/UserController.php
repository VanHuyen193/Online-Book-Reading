<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // Tạo controller: php artisan make:controller name
    function getUser($id){
        $user = User::find($id);
        return view('user', ['user'=>$user]);
    }
}
