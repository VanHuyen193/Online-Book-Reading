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

    <!-- FORM CẬP NHẬT -->
    <form id="book-form" action="{{ route('books.update', $book->id) }}" method="POST">
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
                <x-chapter-list :chapters="$chapters" :book="$book" />
            </div>

            <!-- Right Side: Save + Cancel Buttons -->
            <div class="flex justify-end gap-x-4">
                <a href="{{ url('/admin/books') }}"
                    class="rounded-md bg-gray-500 px-4 py-2 text-white text-sm font-semibold shadow hover:bg-gray-400">
                    Cancel
                </a>
                <button type="submit"
                    class="rounded-md bg-indigo-600 px-4 py-2 text-white text-sm font-semibold shadow hover:bg-indigo-500">
                    Save Changes
                </button>
            </div>
        </div>
    </form>

    <!-- FORM XÓA - TÁCH RIÊNG RA -->
    <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="mt-6"
        onsubmit="return confirm('Are you sure you want to delete this book? This action cannot be undone.');">
        @csrf
        @method('DELETE')
        <button type="submit"
            class="rounded-md bg-red-600 px-4 py-2 text-white text-sm font-semibold shadow hover:bg-red-500">
            Delete Book
        </button>
    </form>



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

            function deleteChapter(bookId, chapterId) {
                if (!confirm('Are you sure you want to delete this chapter?')) return;

                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/books/${bookId}/chapters/${chapterId}`;

                // Lấy CSRF token từ thẻ meta trong <head>
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
                if (!csrfToken) {
                    alert("CSRF token not found. Make sure it's in your <head>.");
                    return;
                }

                // CSRF token
                const tokenInput = document.createElement('input');
                tokenInput.type = 'hidden';
                tokenInput.name = '_token';
                tokenInput.value = csrfToken;
                form.appendChild(tokenInput);

                // Spoof HTTP DELETE method
                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';
                form.appendChild(methodInput);

                document.body.appendChild(form);
                form.submit();
            }
        </script>
    </form>
</x-admin-layout>