<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src='https://cdn.tailwindcss.com'></script>
</head>
<body>
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img class="mx-auto h-10 w-auto" src="https://img.freepik.com/premium-vector/icon-person-reading-book_98396-95018.jpg" alt="Your Company">
            <h2 class="mt-6 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Register</h2>
        </div>

        <div class="mt-6 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-4" action="/register" method="POST">
                @csrf
                <div>
                    <label for="first_name" class="block text-sm font-medium text-gray-900">First name</label>
                    <div>
                        <input name="first_name" id="first_name" autocomplete="first_name" required class="block w-full rounded-md bg-white px-3 py-1 text-gray-900 outline outline-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:outline-indigo-600 sm:text-sm">
                    </div>
                </div>

                <div>
                    <label for="last_name" class="block text-sm font-medium text-gray-900">Last name</label>
                    <div>
                        <input name="last_name" id="last_name" autocomplete="last_name" required class="block w-full rounded-md bg-white px-3 py-1 text-gray-900 outline outline-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:outline-indigo-600 sm:text-sm">
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-900">Email address</label>
                    <div>
                        <input type="email" name="email" id="email" autocomplete="email" required class="block w-full rounded-md bg-white px-3 py-1 text-gray-900 outline outline-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:outline-indigo-600 sm:text-sm">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-900">Password</label>
                    <div>
                        <input type="password" name="password" id="password" autocomplete="current-password" required class="block w-full rounded-md bg-white px-3 py-1 text-gray-900 outline outline-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:outline-indigo-600 sm:text-sm">
                    </div>
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-900">Confirm Password</label>
                    <div>
                        <input type="password" name="password_confirmation" id="password_confirmation" required class="block w-full rounded-md bg-white px-3 py-1 text-gray-900 outline outline-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:outline-indigo-600 sm:text-sm">
                    </div>
                </div>

                <div>
                    <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-indigo-600">Register</button>
                </div>
            </form>

            <p class="mt-6 text-center text-sm text-gray-500">
                <a href="/login" class="font-semibold text-indigo-600 hover:text-indigo-500">Login</a>
            </p>
        </div>
    </div>
</body>
</html>
