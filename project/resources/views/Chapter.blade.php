<x-layout>
    <x-slot:heading>
        Chapter
    </x-slot:heading>
    <h2 class="font-bold text-lg">{{ $chapter->title }}</h2>
    <p>
        {{ $chapter->content }}
    </p>
</x-layout>
