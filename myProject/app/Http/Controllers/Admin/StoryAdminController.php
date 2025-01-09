<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Story;
use Illuminate\Http\Request;

class StoryAdminController extends Controller
{
    // Hiển thị danh sách các truyện
    public function index()
    {
        $stories = Story::all();  // Lấy tất cả truyện
        return view('admin.stories.index', compact('stories'));
    }


    // Hiển thị form thêm truyện mới
    public function create()
    {
        return view('admin.stories.create');
    }

    // Xử lý việc lưu truyện mới vào cơ sở dữ liệu
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Story::create([
            'title' => $request->title,
            'author' => $request->author,
            'description' => $request->description,
        ]);

        return redirect()->route('stories.index')->with('success', 'Truyện đã được thêm thành công.');
    }

    // Hiển thị form chỉnh sửa truyện
    public function edit(Story $story)
    {
        return view('admin.stories.edit', compact('story'));
    }

    // Cập nhật truyện sau khi chỉnh sửa
    public function update(Request $request, Story $story)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $story->update([
            'title' => $request->title,
            'author' => $request->author,
            'description' => $request->description,
        ]);

        return redirect()->route('stories.index')->with('success', 'Truyện đã được cập nhật.');
    }

    // Xóa truyện
    public function destroy(Story $story)
    {
        $story->delete();
        return redirect()->route('stories.index')->with('success', 'Truyện đã bị xóa.');
    }
}
