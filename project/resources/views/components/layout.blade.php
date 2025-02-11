<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src='https://cdn.tailwindcss.com'></script>
</head>
<body>
    <!--
    This example requires updating your template:

    ```
    <html class="h-full bg-gray-100">
    <body class="h-full">
    ```
    -->
    <div class="min-h-full">
    <nav class="bg-gray-800">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center">
            <div class="shrink-0">
                <img class="size-8" src="https://manybooks.net/themes/custom/mnybks/logo.svg" alt="Your Company">
            </div>
            <div class="hidden md:block">
                <div class="ml-10 flex items-baseline space-x-4">
                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                <x-nav-link href="/" :active="request()->is('/')">Home</x-nav-link>
                <x-nav-link href="/books" :active="request()->is('books')">Books</x-nav-link>
                <x-nav-link href="/savedbooks" :active="request()->is('savedbooks')">Saved Books</x-nav-link>
                <x-nav-link href="/contact" :active="request()->is('contact')">Contact</x-nav-link>
                </div>
            </div>
            </div>


                <div class="hidden md:block relative">
                    <div class="ml-4 flex items-center md:ml-6">
                        @guest
                            <x-nav-link href="/login" :active="request()->is('login')">Log In</x-nav-link>
                            <x-nav-link href="/register" :active="request()->is('register')">Register</x-nav-link>
                        @endguest
                        @auth
                            <div class="relative">
                                <button id="user-menu-button" class="flex items-center text-white hover:bg-gray-700 px-3 py-2 rounded-md">
                                    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                                    <svg class="ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06-.02L10 10.83l3.71-3.64a.75.75 0 111.04 1.08l-4.25 4.17a.75.75 0 01-1.04 0L5.25 8.27a.75.75 0 01-.02-1.06z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <div id="user-dropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1">
                                    <a href="/profile" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">View Profile</a>
                                    <form method="POST" action="/logout">
                                        @csrf
                                        <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">Log Out</button>
                                    </form>
                                </div>
                            </div>
                        @endauth
                    </div>
                </div>




            <div class="-mr-2 flex md:hidden">
            <!-- Mobile menu button -->
            <button type="button" class="relative inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" aria-controls="mobile-menu" aria-expanded="false">
                <span class="absolute -inset-0.5"></span>
                <span class="sr-only">Open main menu</span>
                <!-- Menu open: "hidden", Menu closed: "block" -->
                <svg class="block size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
                <!-- Menu open: "block", Menu closed: "hidden" -->
                <svg class="hidden size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
            </div>
        </div>
        </div>

        <!-- Mobile menu, show/hide based on menu state. -->
        <div class="md:hidden" id="mobile-menu">
            <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                <x-nav-link href="/" :active="request()->is('/')">Home</x-nav-link>
                <x-nav-link href="/books" :active="request()->is('books')">Books</x-nav-link>
                <x-nav-link href="/savedbooks" :active="request()->is('savedbooks')">Saved Books</x-nav-link>
                <x-nav-link href="/contact" :active="request()->is('contact')">Contact</x-nav-link>
            </div>
            <div class="ml-4 flex items-center md:ml-6">
            @guest
                <x-nav-link href="/login" :active="request()->is('login')">Log In</x-nav-link>
                <x-nav-link href="/register" :active="request()->is('register')">Register</x-nav-link>
            @endguest
            @auth
                <form method="POST" action="/logout">
                @csrf
                    <x-form-button>Log Out</x-form-button>
                </form>
            @endauth
        </div>
        </div>
        
    </nav>

    <header class="bg-white shadow">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{$heading}}</h1>
        </div>
    </header>
    <main>
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        {{$slot}}
        </div>
    </main>
    </div>

    
</body>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const userMenuButton = document.getElementById("user-menu-button");
        const userDropdown = document.getElementById("user-dropdown");

        userMenuButton.addEventListener("click", function() {
            userDropdown.classList.toggle("hidden");
        });

        document.addEventListener("click", function(event) {
            if (!userMenuButton.contains(event.target) && !userDropdown.contains(event.target)) {
                userDropdown.classList.add("hidden");
            }
        });
    });
</script>



</html>