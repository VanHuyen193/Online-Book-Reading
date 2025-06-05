<x-admin-layout>
    <x-slot:heading>
        Edit Book
    </x-slot:heading>
    @if(session('success'))
        <script>
            alert("{{ session('success') }}");
        </script>
    @endif

    <p class="text-lg font-semibold text-gray-700">Edit the details of the book</p>
    <form action="{{ url('/books/' . $book->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="space-y-12">
            <!-- Book Information Section -->
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base/7 font-semibold text-gray-900">Book Information</h2>
                <p class="mt-1 text-sm/6 text-gray-600">Update the details of the book.</p>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <!-- Book Title -->
                    <div class="sm:col-span-4">
                        <label for="book-title" class="block text-sm/6 font-medium text-gray-900">Book Title</label>
                        <div class="mt-2">
                            <input type="text" name="book-title" id="book-title" value="{{ old('book-title', $book->title) }}" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 outline-gray-300 placeholder:text-gray-400 focus:outline-indigo-600 sm:text-sm/6">
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="col-span-full">
                        <label for="description" class="block text-sm/6 font-medium text-gray-900">Description</label>
                        <div class="mt-2">
                            <textarea name="description" id="description" rows="4" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 outline-gray-300 placeholder:text-gray-400 focus:outline-indigo-600 sm:text-sm/6">{{ old('description', $book->content) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chapter Edit Section -->
            <!-- Chapter List Section -->
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base/7 font-semibold text-gray-900">Chapters</h2>
                <p class="mt-1 text-sm/6 text-gray-600">Click a chapter title to edit its content.</p>

                <ul class="mt-6 space-y-4">
                    @foreach($chapters as $chapter)
                        <li class="flex justify-between items-center p-4 border rounded-md bg-gray-50 hover:bg-gray-100">
                            <a href="{{ url('/books/' . $book->id . '/chapters/' . $chapter->id . '/edit') }}" class="text-indigo-600 hover:underline font-medium">
                                {{ $chapter->title }}
                            </a>
                                <a href="{{ url('/chapters/create?book_id=' . $book->id . '&insert_after=' . $chapter->id) }}"
                                    class="text-green-600 hover:text-green-800 text-xl font-bold ml-4"
                                    title="Insert chapter after this">
                                    [+]
                                </a>
                        </li>
                    @endforeach
                </ul>

                <!-- Optional: Add Chapter Button -->
                <!-- <div class="mt-4">
                    <a href="{{ url('/chapters/create?book_id=' . $book->id) }}" class="inline-block rounded-md bg-green-600 px-4 py-2 text-white text-sm font-semibold shadow hover:bg-green-500">
                        Add New Chapter
                    </a>
                </div> -->
            </div>

            <!-- <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base/7 font-semibold text-gray-900">Chapters</h2>
                <p class="mt-1 text-sm/6 text-gray-600">Edit the chapters of your book.</p>

                <div class="mt-6 space-y-6" id="chapter-container">
                    @foreach($chapters as $index => $chapter)
                    <div class="chapter-item relative border p-4 rounded-md bg-gray-50">
                        <div class="sm:col-span-4">
                            <label class="block text-sm/6 font-medium text-gray-900">Chapter Title</label>
                            <div class="mt-2">
                                <input type="text" name="chapter-title[]" value="{{ old('chapter-title.' . $index, $chapter->title) }}" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 outline-gray-300 placeholder:text-gray-400 focus:outline-indigo-600 sm:text-sm/6">
                            </div>
                        </div>

                        <div class="col-span-full mt-4">
                            <label class="block text-sm/6 font-medium text-gray-900">Chapter Content</label>
                            <div class="mt-2">
                                <textarea name="chapter-content[]" rows="4" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 outline-gray-300 placeholder:text-gray-400 focus:outline-indigo-600 sm:text-sm/6">{{ old('chapter-content.' . $index, $chapter->content) }}</textarea>
                            </div>
                        </div> -->

                        <!-- Delete Chapter Button -->
                        <!-- <button type="button" class="absolute top-4 right-4 text-red-600 text-sm font-semibold hover:text-red-800" onclick="removeChapter(this)">
                            Delete Chapter
                        </button>
                    </div>
                    @endforeach
                </div> -->

                <!-- Add Chapter Button -->
                <!-- <div class="mt-4">
                    <button type="button" onclick="addChapter()" class="rounded-md bg-green-600 px-4 py-2 text-white text-sm font-semibold shadow hover:bg-green-500">
                        Add Chapter
                    </button>
                </div>
            </div> -->

            <!-- Submit Button -->
            <div class="mt-6 flex justify-end">
                <button type="submit" class="rounded-md bg-indigo-600 px-4 py-2 text-white text-sm font-semibold shadow hover:bg-indigo-500">
                    Save Changes
                </button>
            </div>
        </div>
    </form>

    <!-- Form Xóa Sách -->
    <form action="{{ url('/books/' . $book->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this book? This action cannot be undone.');">
        @csrf
        @method('DELETE')
        <button type="submit" class="rounded-md bg-red-600 px-4 py-2 text-white text-sm font-semibold shadow hover:bg-red-500">
            Delete Book
        </button>
    </form>
    
    <script>
        // Function to add a new chapter section
        function addChapter() {
            const chapterContainer = document.getElementById('chapter-container');
            const newChapter = document.createElement('div');
            newChapter.classList.add('chapter-item', 'relative', 'border', 'p-4', 'rounded-md', 'bg-gray-50', 'mt-6');

            newChapter.innerHTML = `
                <div class="sm:col-span-4">
                    <label class="block text-sm/6 font-medium text-gray-900">Chapter Title</label>
                    <div class="mt-2">
                        <input type="text" name="chapter-title[]" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 outline-gray-300 placeholder:text-gray-400 focus:outline-indigo-600 sm:text-sm/6" placeholder="Enter the chapter title">
                    </div>
                </div>

                <div class="col-span-full mt-4">
                    <label class="block text-sm/6 font-medium text-gray-900">Chapter Content</label>
                    <div class="mt-2">
                        <textarea name="chapter-content[]" rows="4" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 outline-gray-300 placeholder:text-gray-400 focus:outline-indigo-600 sm:text-sm/6" placeholder="Write the content of the chapter..."></textarea>
                    </div>
                </div>

                <!-- Delete Chapter Button -->
                <button type="button" class="absolute top-4 right-4 text-red-600 text-sm font-semibold hover:text-red-800" onclick="removeChapter(this)">
                    Delete Chapter
                </button>
            `;

            chapterContainer.appendChild(newChapter);
        }

        // Function to remove a chapter section
        function removeChapter(button) {
            const chapterItem = button.closest('.chapter-item');
            chapterItem.remove();
        }
    </script>
</x-admin-layout>
