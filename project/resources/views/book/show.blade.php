<x-layout>
    <x-slot:heading>
        Book
    </x-slot:heading>
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
</x-layout>
