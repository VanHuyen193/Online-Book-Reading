<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }
    public function store()
    {
        $attributes = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
        if (! Auth::attempt($attributes)) {
            throw ValidationException::withMessages([
                'email' => 'Sorry, those credentials do not match.'
            ]);
        }
        request()->session()->regenerate();

        if (Auth::user()->is_admin) {
            // Chuyển hướng admin
            return redirect('https://laughing-space-bassoon-4x6gv6xgjrp2j9gq-8000.app.github.dev/books/create'); 
            // dd(request()->all());
        }

        return redirect('https://laughing-space-bassoon-4x6gv6xgjrp2j9gq-8000.app.github.dev/books');
    }
    public function destroy()
    {
        Auth::logout();
        return redirect('https://laughing-space-bassoon-4x6gv6xgjrp2j9gq-8000.app.github.dev/');
    }
}