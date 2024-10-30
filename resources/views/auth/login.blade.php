<head>
    <title>Human Shop</title>
    <link rel="icon" href="{{ asset('img/Logo.jpg') }}" type="image/jpeg">
    <style>
        /* Spooky gradient background for the container */
        .form-container {
            background: linear-gradient(145deg, #1b1f2f, #2a2e45);
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.5);
            border-radius: 0.75rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        /* Hover effect for container */
        .form-container:hover {
            transform: scale(1.02);
            box-shadow: 0px 15px 25px rgba(0, 0, 0, 0.6);
        }

        /* Input field hover and focus effects */
        .input-field {
            background: #2a3b4c;
            border: none;
            color: #f8fafc;
            transition: background-color 0.3s ease;
        }

        .input-field:focus {
            background: #353b52;
        }

        /* Button styling with a spooky orange glow */
        .btn {
            background: #e67e22;
            color: #1a202c;
            border-radius: 0.5rem;
            transition: background 0.3s ease, box-shadow 0.3s ease;
        }

        .btn:hover {
            background: #d35400;
            box-shadow: 0px 4px 10px rgba(230, 126, 34, 0.4);
        }
    </style>
</head>

<x-guest-layout>
    <div class="max-w-md mx-auto p-8 mt-10 form-container shadow-lg">
        <h2 class="text-2xl font-bold text-orange-500 text-center mb-6">Log In</h2>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-4">
                <x-input-label for="email" :value="__('Email')" class="text-orange-500" />
                <x-text-input id="email"
                    class="input-field block w-full mt-1 rounded-md focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                    type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <x-input-label for="password" :value="__('Password')" class="text-orange-500" />
                <x-text-input id="password"
                    class="input-field block w-full mt-1 rounded-md focus:ring-2 focus:ring-orange-500 focus:border-orange-500"
                    type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center mb-4">
                <label for="remember_me" class="inline-flex items-center text-gray-400">
                    <input id="remember_me" type="checkbox"
                        class="rounded bg-gray-700 border-gray-600 text-orange-500 focus:ring-2 focus:ring-orange-500"
                        name="remember">
                    <span class="ml-2 text-sm">{{ __('Remember me') }}</span>
                </label>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-between">
                @if (Route::has('password.request'))
                    <a class="text-sm text-gray-400 hover:text-orange-400 transition duration-300"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-primary-button
                    class="btn font-semibold px-4 py-2 transition duration-300 focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>