<x-layout>
    <x-slot:heading>
        Saved Books Page
    </x-slot:heading>

    @if(isset($message))
        <p>{{ $message }}</p>
    @endif

    <div class=" mt-8">
        <div class="bg-white shadow-md rounded-lg">
            <ul class="divide-y divide-gray-200">
            @foreach ($savedBooks as $savedBook)
                <li class="flex items-center justify-between px-6 py-4 hover:bg-gray-100 transition duration-200">
                    <a href="/books/{{ $savedBook->book->id }}" class="flex items-center space-x-4 text-gray-700 hover:text-blue-600">
                        <span class="text-lg font-semibold">{{ $savedBook->book->title }}</span>
                    </a>
                    <!-- Form Xóa Sách -->
                    <form action="{{ url('savedbooks/' . $savedBook->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this book? This action cannot be undone.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="rounded-md bg-red-600 px-4 py-2 text-white text-sm font-semibold shadow hover:bg-red-500">
                            Delete Book
                        </button>
                    </form>
                </li>
            @endforeach
            </ul>
        </div>
    </div>
</x-layout>