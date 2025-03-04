<x-admin-layout>
    <x-slot:heading>
        Create a New Book
    </x-slot:heading>
    @if(session('success'))
        <script>
            alert("{{ session('success') }}");
        </script>
    @endif

    <p class="text-lg font-semibold text-gray-700">Add a new book to the library collection</p>
    <form action="{{ url('/books') }}" method="POST">
    @csrf
        <div class="space-y-12">
            <!-- Book Information Section -->
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base/7 font-semibold text-gray-900">Book Information</h2>
                <p class="mt-1 text-sm/6 text-gray-600">Fill in the details of the book.</p>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <!-- Book Title -->
                    <div class="sm:col-span-4">
                        <label for="book-title" class="block text-sm/6 font-medium text-gray-900">Book Title</label>
                        <div class="mt-2">
                            <input type="text" name="book-title" id="book-title" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 outline-gray-300 placeholder:text-gray-400 focus:outline-indigo-600 sm:text-sm/6" placeholder="Enter the book title">
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="col-span-full">
                        <label for="description" class="block text-sm/6 font-medium text-gray-900">Description</label>
                        <div class="mt-2">
                            <textarea name="description" id="description" rows="4" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 outline-gray-300 placeholder:text-gray-400 focus:outline-indigo-600 sm:text-sm/6" placeholder="Write a brief description of the book..."></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chapter Creation Section -->
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base/7 font-semibold text-gray-900">Chapters</h2>
                <p class="mt-1 text-sm/6 text-gray-600">Add chapters to your book. You can add multiple chapters with titles and content.</p>

                <div class="mt-6 space-y-6" id="chapter-container">
                    <!-- Chapter Template -->
                    <div class="chapter-item relative border p-4 rounded-md bg-gray-50">
                        <div class="sm:col-span-4">
                            <label for="chapter-title" class="block text-sm/6 font-medium text-gray-900">Chapter Title</label>
                            <div class="mt-2">
                                <input type="text" name="chapter-title[]" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 outline-gray-300 placeholder:text-gray-400 focus:outline-indigo-600 sm:text-sm/6" placeholder="Enter the chapter title">
                            </div>
                        </div>

                        <div class="col-span-full mt-4">
                            <label for="chapter-content" class="block text-sm/6 font-medium text-gray-900">Chapter Content</label>
                            <div class="mt-2">
                                <textarea name="chapter-content[]" rows="4" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 outline-gray-300 placeholder:text-gray-400 focus:outline-indigo-600 sm:text-sm/6" placeholder="Write the content of the chapter..."></textarea>
                            </div>
                        </div>

                        <!-- Delete Chapter Button -->
                        <button type="button" class="absolute top-4 right-4 text-red-600 text-sm font-semibold hover:text-red-800" onclick="removeChapter(this)">
                            Delete Chapter
                        </button>
                    </div>
                </div>

                <!-- Add Chapter Button -->
                <div class="mt-4">
                    <button type="button" onclick="addChapter()" class="rounded-md bg-green-600 px-4 py-2 text-white text-sm font-semibold shadow hover:bg-green-500">
                        Add Chapter
                    </button>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="mt-6 flex justify-end">
                <button type="submit" class="rounded-md bg-indigo-600 px-4 py-2 text-white text-sm font-semibold shadow hover:bg-indigo-500">
                    Save Book
                </button>
            </div>
        </div>
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
