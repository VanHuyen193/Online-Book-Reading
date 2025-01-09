<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Story;
use Illuminate\Http\Request;

class ChapterAdminController extends Controller
{
    // Hiển thị form tạo chương mới cho một truyện
    public function create($storyId)
    {
        $story = Story::findOrFail($storyId);
        return view('admin.chapters.create', compact('story'));
    }

    // Lưu chương truyện vào cơ sở dữ liệu
    public function store(Request $request, $storyId)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $story = Story::findOrFail($storyId);

        $story->chapters()->create([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('admin.stories.show', $storyId)->with('success', 'Chương đã được thêm thành công.');
    }

    // Hiển thị form chỉnh sửa chương truyện
    public function edit($storyId, $chapterId)
    {
        $chapter = Chapter::findOrFail($chapterId);
        return view('admin.chapters.edit', compact('chapter'));
    }

    // Cập nhật thông tin chương truyện
    public function update(Request $request, $storyId, $chapterId)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $chapter = Chapter::findOrFail($chapterId);
        $chapter->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('admin.stories.show', $storyId)->with('success', 'Chương đã được cập nhật.');
    }

    // Xóa chương truyện
    public function destroy($storyId, $chapterId)
    {
        $chapter = Chapter::findOrFail($chapterId);
        $chapter->delete();
        return redirect()->route('admin.stories.show', $storyId)->with('success', 'Chương đã bị xóa.');
    }
}
