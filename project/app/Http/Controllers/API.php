<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\Chapter;
use App\Models\SavedBook;
use Illuminate\Http\Request;

class API extends Controller
{
    public function showSavedBook()
    {
        // Lấy ID của người dùng hiện tại
        $userId = auth()->id();

        // Kiểm tra nếu người dùng chưa đăng nhập
        if (!$userId) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }

        // Lấy danh sách sách đã lưu
        $savedBooks = SavedBook::with('book') // Include book details
            ->where('user_id', $userId)
            ->get();

        // Trả về danh sách sách dưới dạng JSON
        return response()->json([
            'message' => 'Saved books retrieved successfully',
            'data' => $savedBooks,
        ]);
    }
}
