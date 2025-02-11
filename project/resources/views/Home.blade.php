<x-layout>
    <x-slot:heading>
        Home Page
    </x-slot:heading>
    @if(session('success'))
        <script>
            alert("{{ session('success') }}");
        </script>
    @endif
    <h1>This is home page</h1>
</x-layout>