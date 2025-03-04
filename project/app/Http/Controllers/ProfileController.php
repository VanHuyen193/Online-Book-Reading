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
        try {
            $user = Auth::user();

            $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'password' => 'nullable|min:6|confirmed',
            ]);

            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;

            if ($request->password) {
                $user->password = Hash::make($request->password);
            }

            $user->save();

            return redirect(url('/profile'))->with('success', 'Profile updated successfully!');
        } catch (\Exception $e) {
            return redirect(url('/profile'))->with('error', 'Something went wrong! Please try again.');
        }
    }


    public function destroy()
    {
        $user = Auth::user();
        Auth::logout();
        $user->delete();

        return redirect(url('/'))->with('success', 'Deleted!');
    }
}

