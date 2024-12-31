<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    public function show($id)
    {
        $chapter = Chapter::findOrFail($id);
        return view('chapters.show', compact('chapter'));
    }

    public function create($story_id)
    {
        return view('chapters.create', compact('story_id'));
    }


    public function store(Request $request)
    {
        // Validate dữ liệu
        $validated = $request->validate([
            'story_id' => 'required|exists:stories,id',
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        // Lưu dữ liệu vào bảng chapters
        Chapter::create($validated);

        // Chuyển hướng về trang truyện sau khi thêm chương thành công
        return redirect()->route('story.show', $request->story_id)
            ->with('success', 'Chương mới đã được thêm thành công!');
    }

    public function edit($id)
    {
        $chapter = Chapter::findOrFail($id);
        return view('chapters.edit', compact('chapter'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $chapter = Chapter::findOrFail($id);
        $chapter->update($validated);

        return redirect()->route('chapter.show', $id)
            ->with('success', 'Chapter updated successfully!');
    }

    public function destroy($id)
    {
        $chapter = Chapter::findOrFail($id);
        $chapter->delete();

        return back()->with('success', 'Chapter deleted successfully!');
    }

}
