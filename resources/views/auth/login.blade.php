<head>
    <title>Human_shop</title>
    <link rel="icon" href="{{ asset('img/group21.jpg') }}" type="image/jpeg">
</head>

<x-guest-layout>
    <div class="max-w-md mx-auto p-8 bg-gray-800 rounded-lg shadow-lg mt-10">
        <h2 class="text-2xl font-bold text-yellow-400 text-center mb-6">Log In</h2>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-4">
                <x-input-label for="email" :value="__('Email')" class="text-yellow-400" />
                <x-text-input id="email"
                    class="block w-full mt-1 bg-gray-700 text-white rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500"
                    type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <x-input-label for="password" :value="__('Password')" class="text-yellow-400" />
                <x-text-input id="password"
                    class="block w-full mt-1 bg-gray-700 text-white rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500"
                    type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center mb-4">
                <label for="remember_me" class="inline-flex items-center text-gray-400">
                    <input id="remember_me" type="checkbox"
                        class="rounded bg-gray-700 border-gray-600 text-yellow-500 focus:ring-2 focus:ring-yellow-500"
                        name="remember">
                    <span class="ml-2 text-sm">{{ __('Remember me') }}</span>
                </label>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-between">
                @if (Route::has('password.request'))
                    <a class="text-sm text-gray-400 hover:text-yellow-400 transition duration-300"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-primary-button
                    class="bg-yellow-500 hover:bg-yellow-400 text-gray-800 font-semibold px-4 py-2 rounded-md transition duration-300 focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>