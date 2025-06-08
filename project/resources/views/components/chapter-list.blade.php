{{-- Tạo file: resources/views/components/chapter-list.blade.php --}}
<ul class="mt-6 space-y-4">
    @foreach($chapters as $chapter)
        <li class="border rounded-md bg-gray-50 hover:bg-gray-100 p-4">
            <div class="flex justify-between items-center flex-wrap gap-4">
                <a href="{{ url('/books/' . $book->id . '/chapters/' . $chapter->id . '/edit') }}"
                    class="text-indigo-600 hover:underline font-medium block">
                    {{ $chapter->title }}
                </a>

                <div class="flex items-center space-x-2">
                    <!-- Nút thêm chương sau -->
                    <button type="button" onclick="insertChapter({{ $book->id }}, {{ $chapter->id }})"
                        class="text-green-600 hover:text-green-800 text-xl font-bold" title="Insert chapter after this">
                        [+]
                    </button>
                    
                    <button type="button" onclick="deleteChapter({{ $book->id }}, {{ $chapter->id }})"
                        class="text-red-600 hover:text-red-800 text-xl font-bold" title="Delete chapter">
                        [-]
                    </button>
                </div>
            </div>
        </li>
    @endforeach
</ul>