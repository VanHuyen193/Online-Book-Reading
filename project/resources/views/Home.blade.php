<x-layout>
    <x-slot:heading>
        Home Page
    </x-slot:heading>

    @if(session('success'))
        <script>
            alert("{{ session('success') }}");
        </script>
    @endif

    <h1 class="text-2xl font-semibold text-gray-800">Welcome to the Home Page</h1>
    <p class="mt-4 text-lg text-gray-600">
        Here you can find various information, updates, and features of our website. Explore the different sections to learn more!
    </p>

    <div class="mt-8 space-y-6">
        <h2 class="text-xl font-semibold text-gray-800">Latest Updates</h2>
        <ul class="space-y-4">
            <li class="bg-gray-100 p-4 rounded-md shadow-md">
                <h3 class="font-bold text-gray-700">New Book Collection Released!</h3>
                <p class="text-gray-600">We have just added a new collection of books to our library. Check them out now!</p>
                <a href="/books" class="text-indigo-600 hover:text-indigo-800">View Collection</a>
            </li>

            <li class="bg-gray-100 p-4 rounded-md shadow-md">
                <h3 class="font-bold text-gray-700">New Features Coming Soon</h3>
                <p class="text-gray-600">We are working on adding new features. Stay tuned for the upcoming updates!</p>
                <a href="/" class="text-indigo-600 hover:text-indigo-800">Learn More</a>
            </li>
        </ul>
    </div>
</x-layout>
