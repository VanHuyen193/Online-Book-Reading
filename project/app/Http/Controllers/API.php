<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chapter;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class API extends Controller
{
    public function viewChapter($bookId, $chapterId)
    {
        $chapter = Chapter::where('book_id', $bookId)
                          ->where('id', $chapterId)
                          ->first();

        if (!$chapter) {
            return response()->json(['message' => 'Chapter not found'], 404);
        }

        $previousChapter = Chapter::where('book_id', $bookId)
            ->where('id', '<', $chapterId)
            ->orderBy('id', 'desc')
            ->first();

        $nextChapter = Chapter::where('book_id', $bookId)
            ->where('id', '>', $chapterId)
            ->orderBy('id', 'asc')
            ->first();

        return response()->json([
            'message' => 'Chapter retrieved successfully',
            'data' => [
                'chapter' => $chapter,
                'previous_chapter' => $previousChapter,
                'next_chapter' => $nextChapter,
            ]
        ]);
    }

    public function users()
    {
        $users = User::all();
        return response()->json([
            'message' => 'Users retrieved successfully',
            'data' => $users
        ], 200);
    }

    public function addUser(Request $request)
    {
        // Validate dữ liệu đầu vào
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        // Tạo user mới
        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']), 
        ]);

        return response()->json([
            'message' => 'User created successfully!',
            'data' => $user
        ], 201);
    }
}
