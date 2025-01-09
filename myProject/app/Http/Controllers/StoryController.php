<?php

namespace App\Http\Controllers;

use App\Models\Story;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    public function index(Request $request)
    {
        // Lấy từ khóa tìm kiếm
        $search = $request->input('search');

        // Lấy danh sách truyện, có phân trang và tìm kiếm
        $stories = Story::when($search, function ($query, $search) {
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%");
        })
        ->orderBy('title', 'asc') // Sắp xếp theo tên truyện
        ->paginate(10);

        return view('stories.index', compact('stories', 'search'));
    }
}

