<x-admin-layout>
    <x-slot:heading>Add New Chapter</x-slot:heading>

    <form method="POST" action="{{ route('chapters.store') }}" class="space-y-6">
        @csrf

        <!-- Hidden fields -->
        <input type="hidden" name="book_id" value="{{ $book->id }}">
        @if (!empty($insertAfterId))
            <input type="hidden" name="insert_after" value="{{ $insertAfterId }}">
        @endif

        <!-- Title -->
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
            <input
                type="text"
                name="title"
                id="title"
                value="{{ old('title') }}"
                class="block w-full max-w-4xl rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-base px-3 py-2"
                required
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
                required
            >{{ old('content') }}</textarea>
        </div>

        <!-- Submit -->
        <div>
            <button
                type="submit"
                class="inline-flex items-center rounded-md bg-green-600 px-4 py-2 text-sm font-semibold text-white shadow hover:bg-green-500"
            >
                Add Chapter
            </button>
        </div>
    </form>
</x-admin-layout>
