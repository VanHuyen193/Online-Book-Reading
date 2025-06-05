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
                            <input type="text" name="book-title" id="book-title"
                                value="{{ old('book-title', $book->title) }}"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 outline-gray-300 placeholder:text-gray-400 focus:outline-indigo-600 sm:text-sm/6">
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="col-span-full">
                        <label for="description" class="block text-sm/6 font-medium text-gray-900">Description</label>
                        <div class="mt-2">
                            <textarea name="description" id="description" rows="4"
                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 outline-gray-300 placeholder:text-gray-400 focus:outline-indigo-600 sm:text-sm/6">{{ old('description', $book->content) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chapter List Section -->
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base/7 font-semibold text-gray-900">Chapters</h2>
                <p class="mt-1 text-sm/6 text-gray-600">Click a chapter title to edit its content.</p>

                <ul class="mt-6 space-y-4">
                    @foreach($chapters as $chapter)
                        <li class="flex justify-between items-center p-4 border rounded-md bg-gray-50 hover:bg-gray-100">
                            <a href="{{ url('/books/' . $book->id . '/chapters/' . $chapter->id . '/edit') }}"
                                class="text-indigo-600 hover:underline font-medium">
                                {{ $chapter->title }}
                            </a>
                            <div class="flex items-center space-x-2">
                                <!-- Nút thêm chương sau -->
                                <button type="button" onclick="insertChapter({{ $book->id }}, {{ $chapter->id }})"
                                    class="text-green-600 hover:text-green-800 text-xl font-bold"
                                    title="Insert chapter after this">
                                    [+]
                                </button>



                                <!-- Nút xóa chương -->
                                <form action="{{ route('chapters.delete', [$book->id, $chapter->id]) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this chapter?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-green-800 text-xl font-bold"
                                        title="Delete chapter">
                                        [-]
                                    </button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>

            </div>

            <!-- Submit, Delete, and Cancel Buttons on the same row -->
            <div class="mt-6 flex justify-between items-center">
                <!-- Delete Form (bên trái) -->
                <form action="{{ url('/books/' . $book->id) }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this book? This action cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="rounded-md bg-red-600 px-4 py-2 text-white text-sm font-semibold shadow hover:bg-red-500">
                        Delete Book
                    </button>
                </form>

                <!-- Right Side: Save + Cancel Buttons -->
                <div class="flex gap-x-4">
                    <a href="{{ url('/admin/books') }}"
                        class="rounded-md bg-gray-500 px-4 py-2 text-white text-sm font-semibold shadow hover:bg-gray-400">
                        Cancel
                    </a>
                    <button type="submit" form="book-form"
                        class="rounded-md bg-indigo-600 px-4 py-2 text-white text-sm font-semibold shadow hover:bg-indigo-500">
                        Save Changes
                    </button>
                </div>
            </div>

            <script>
                function insertChapter(bookId, insertAfterId) {
                    const form = document.createElement('form');
                    form.method = 'GET'; 
                    form.action = '/chapters/create';

                    const bookInput = document.createElement('input');
                    bookInput.type = 'hidden';
                    bookInput.name = 'book_id';
                    bookInput.value = bookId;

                    const afterInput = document.createElement('input');
                    afterInput.type = 'hidden';
                    afterInput.name = 'insert_after';
                    afterInput.value = insertAfterId;

                    form.appendChild(bookInput);
                    form.appendChild(afterInput);
                    document.body.appendChild(form);
                    form.submit();
                }
            </script>

</x-admin-layout>