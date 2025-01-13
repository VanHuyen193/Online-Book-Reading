<x-layout>
    <x-slot:heading>
        Books Listings
    </x-slot:heading>
    <div class=" mt-8">
        <div class="bg-white shadow-md rounded-lg">
            <ul class="divide-y divide-gray-200">
                @foreach ($books as $book)
                    <li class="px-6 py-4 hover:bg-gray-100 transition duration-200">
                        <a href="/books/{{ $book['id'] }}" class="flex items-center space-x-4 text-gray-700 hover:text-blue-600">
                            <span class="text-lg font-semibold">{{ $book['title'] }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <!-- Phân trang -->
        <div class="mt-4">
            {{ $books->links() }}
        </div>
    </div>
</x-layout>
