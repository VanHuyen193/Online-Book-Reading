<?php

// app/Http/Controllers/ProfileController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        return view('Profile');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'password' => 'nullable|min:8|confirmed',
        ]);

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return redirect('https://laughing-space-bassoon-4x6gv6xgjrp2j9gq-8000.app.github.dev/profile')
         ->with('success', 'Profile updated successfully!');
        // dd($request->all());
    }

    public function destroy()
    {
        $user = Auth::user();
        Auth::logout();
        $user->delete();

        return redirect('https://laughing-space-bassoon-4x6gv6xgjrp2j9gq-8000.app.github.dev/')->with('success', 'Deleted!');
    }
}

