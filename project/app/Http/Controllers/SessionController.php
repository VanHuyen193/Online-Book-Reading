<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        if (!Auth::attempt($attributes)) {
            return back()->withErrors([
                'email' => 'Email or password is incorrect. Please try again.'
            ])->withInput();
        }

        request()->session()->regenerate();

        if (Auth::user()->is_admin) {
            return redirect(url('/admin'));
        }

        return redirect(url('/books'));
    }

    public function destroy()
    {
        Auth::logout();
        return redirect(url('/'));
    }
}
