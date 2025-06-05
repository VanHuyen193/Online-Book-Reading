<x-admin-layout>
    <x-slot:heading>Edit Chapter</x-slot:heading>

    <form method="POST" action="{{ route('chapters.update', [$book->id, $chapter->id]) }}" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Title -->
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
            <input
                type="text"
                name="title"
                id="title"
                value="{{ old('title', $chapter->title) }}"
                class="block w-full max-w-4xl rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-base px-3 py-2"
            >
        </div>

        <!-- Content -->
        <div>
            <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Content</label>
            <textarea
                name="content"
                id="content"
                rows="12"
                class="block w-full max-w-5xl rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-base px-3 py-2"
            >{{ old('content', $chapter->content) }}</textarea>
        </div>

        <!-- Submit and Cancel Buttons -->
        <div class="w-full max-w-5xl flex justify-end space-x-3">
            <!-- Cancel Button -->
            <a
                href="{{ route('books.edit', $book->id) }}"
                class="inline-flex items-center rounded-md bg-gray-300 px-4 py-2 text-sm font-semibold text-gray-800 shadow hover:bg-gray-400"
            >
                Cancel
            </a>

            <!-- Update Button -->
            <button
                type="submit"
                class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow hover:bg-indigo-500"
            >
                Update Chapter
            </button>
        </div>


    </form>
</x-admin-layout>
