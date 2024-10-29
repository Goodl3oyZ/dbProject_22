<head>
    <title>Human_shop</title>
    <link rel="icon" href="{{ asset('img/group21.jpg') }}" type="image/jpeg">
</head>

<x-guest-layout>
    <div class="max-w-md mx-auto p-8 bg-gray-800 rounded-lg shadow-lg mt-10">
        <h2 class="text-2xl font-bold text-yellow-400 text-center mb-6">Register</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <x-input-label for="name" :value="__('Name')" class="text-yellow-400" />
                <x-text-input id="name"
                    class="block w-full mt-1 bg-gray-700 text-white rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500"
                    type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500" />
            </div>

            <!-- Email Address -->
            <div class="mb-4">
                <x-input-label for="email" :value="__('Email')" class="text-yellow-400" />
                <x-text-input id="email"
                    class="block w-full mt-1 bg-gray-700 text-white rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500"
                    type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <x-input-label for="password" :value="__('Password')" class="text-yellow-400" />
                <x-text-input id="password"
                    class="block w-full mt-1 bg-gray-700 text-white rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500"
                    type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
            </div>

            <!-- Confirm Password -->
            <div class="mb-6">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-yellow-400" />
                <x-text-input id="password_confirmation"
                    class="block w-full mt-1 bg-gray-700 text-white rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500"
                    type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500" />
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-between">
                <a class="text-sm text-gray-400 hover:text-yellow-400 transition duration-300"
                    href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button
                    class="bg-yellow-500 hover:bg-yellow-400 text-gray-800 font-semibold px-4 py-2 rounded-md transition duration-300 focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>