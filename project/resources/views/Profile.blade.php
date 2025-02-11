<x-layout>
    <x-slot:heading>
        Edit Profile
    </x-slot:heading>

    @if(session('success'))
        <script>
            alert("{{ session('success') }}");
        </script>
    @endif

    <p class="text-lg font-semibold text-gray-700">Update your profile information</p>
    <form action="{{'https://laughing-space-bassoon-4x6gv6xgjrp2j9gq-8000.app.github.dev/profile/update'}}" method="POST">
        @csrf
        @method('PUT')
        <div class="space-y-12">
            <!-- User Information Section -->
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold text-gray-900">Profile Information</h2>
                <p class="mt-1 text-sm text-gray-600">Update your profile details.</p>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <!-- Name -->
                    <div class="sm:col-span-4">
                        <label for="first_name" class="block text-sm font-medium text-gray-900">First Name</label>
                        <div class="mt-2">
                            <input type="text" name="first_name" id="first_name" value="{{ old('first_name', Auth::user()->first_name) }}" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 outline-gray-300 placeholder:text-gray-400 focus:outline-indigo-600 sm:text-sm">
                        </div>
                        
                        <label for="last_name" class="block text-sm font-medium text-gray-900">Last Name</label>
                        <div class="mt-2">
                            <input type="text" name="last_name" id="last_name" value="{{ old('last_name', Auth::user()->last_name) }}" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 outline-gray-300 placeholder:text-gray-400 focus:outline-indigo-600 sm:text-sm">
                        </div>
                    </div>

                    <!-- Email (Readonly) -->
                    <div class="sm:col-span-4">
                        <label for="email" class="block text-sm font-medium text-gray-900">Email</label>
                        <div class="mt-2">
                            <input type="email" name="email" id="email" value="{{ Auth::user()->email }}" class="block w-full rounded-md bg-gray-100 px-3 py-1.5 text-base text-gray-500 outline outline-1 outline-gray-300 sm:text-sm" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Password Update Section -->
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold text-gray-900">Change Password</h2>
                <p class="mt-1 text-sm text-gray-600">Enter a new password to update.</p>

                <div class="mt-6 space-y-6">
                    <!-- New Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-900">New Password</label>
                        <div class="mt-2">
                            <input type="password" name="password" id="password" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 outline-gray-300 placeholder:text-gray-400 focus:outline-indigo-600 sm:text-sm">
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-900">Confirm Password</label>
                        <div class="mt-2">
                            <input type="password" name="password_confirmation" id="password_confirmation" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 outline-gray-300 placeholder:text-gray-400 focus:outline-indigo-600 sm:text-sm">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="mt-6 flex">
                <button type="submit" class="rounded-md bg-indigo-600 px-4 py-2 text-white text-sm font-semibold shadow hover:bg-indigo-500">
                    Save Changes
                </button>
            </div>
        </div>
    </form>

    <!-- Delete Account Form -->
    <form action="{{ 'https://laughing-space-bassoon-4x6gv6xgjrp2j9gq-8000.app.github.dev/profile/delete' }}" method="POST" onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.');" class="mt-4">
        @csrf
        @method('DELETE')
        <button type="submit" class="rounded-md bg-red-600 px-4 py-2 text-white text-sm font-semibold shadow hover:bg-red-500">
            Delete Account
        </button>
    </form>
</x-layout>