<x-admin-layout>
    <x-slot:heading>
        Books Listings
    </x-slot:heading>
    @if(session('success'))
        <script>
            alert("{{ session('success') }}");
        </script>
    @endif

    <!-- Thanh tìm kiếm -->
    <!-- books?search=est -->
    <form method="GET" action="{{ 'https://laughing-space-bassoon-4x6gv6xgjrp2j9gq-8000.app.github.dev/admin/books' }}" class="mb-4">
        <div class="flex items-center border rounded-md p-2 bg-white shadow-sm">
            <input type="text" name="search" placeholder="Search books..." value="{{ request('search') }}" 
                   class="flex-1 px-4 py-2 outline-none text-gray-700">
            <button type="submit" class="ml-2 bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                Search
            </button>
        </div>
    </form>

    <div class=" mt-8">
        <div class="bg-white shadow-md rounded-lg">
            <ul class="divide-y divide-gray-200">
                @foreach ($books as $book)
                    <li class="px-6 py-4 hover:bg-gray-100 transition duration-200">
                        <a href="/books/{{ $book['id'] }}/edit" class="flex items-center space-x-4 text-gray-700 hover:text-blue-600">
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
</x-admin-layout>
