<x-layout>
    <x-slot:heading>
        Book
    </x-slot:heading>
    @if (session('info'))
        <div class="bg-blue-100 text-blue-800 px-4 py-2 rounded mb-4 relative">
            <span>{{ session('info') }}</span>
            <!-- Close Button -->
            <button 
                class="absolute top-1/2 right-4 transform -translate-y-1/2 text-blue-800 hover:text-blue-600 font-bold"
                onclick="this.parentElement.remove();">
                &times;
            </button>
        </div>
    @endif
    
    @if(session('error'))
        <div class="bg-blue-100 text-blue-800 px-4 py-2 rounded mb-4 relative">
            <span>{{ session('error') }}</span>
            <!-- Close Button -->
            <button 
                class="absolute top-1/2 right-4 transform -translate-y-1/2 text-blue-800 hover:text-blue-600 font-bold"
                onclick="this.parentElement.remove();">
                &times;
            </button>
        </div>
    @endif

    @if(session('success'))
        <div class="bg-blue-100 text-blue-800 px-4 py-2 rounded mb-4 relative">
            <span>{{ session('success') }}</span>
            <!-- Close Button -->
            <button 
                class="absolute top-1/2 right-4 transform -translate-y-1/2 text-blue-800 hover:text-blue-600 font-bold"
                onclick="this.parentElement.remove();">
                &times;
            </button>
        </div>
    @endif


    <h2 class="font-bold text-lg">{{ $book->title }}</h2>
    <p>
        {{ $book->content }}
    </p>

    <h3 class="font-bold text-md mt-4">Chapters</h3>
    @if ($book->chapters->isNotEmpty())
        <ul>
            @foreach ($book->chapters as $chapter)
                <li>
                    <a href="/books/{{ $book->id }}/chapters/{{ $chapter->id }}" class="text-blue-500 hover:underline">
                        {{ $chapter->title }}
                    </a>
                </li>
            @endforeach
        </ul>
    @else
        <p>No chapters available for this book.</p>
    @endif

    <form action="/books/{{ $book->id }}/save" method="POST" class="mt-6">
        @csrf
        <button type="submit" class="rounded-md bg-indigo-600 px-4 py-2 text-white text-sm font-semibold shadow hover:bg-indigo-500">
            Save
        </button>
    </form>
</x-layout>
