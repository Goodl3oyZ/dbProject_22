<head>
    <title>Human Shop - Register</title>
    <link rel="icon" href="{{ asset('img/Logo.jpg') }}" type="image/jpeg">
    <style>
        /* Spooky gradient background for the form container */
        .form-container {
            background: linear-gradient(135deg, #1e1f29, #2a2d3e);
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.6);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        /* Hover effect for container */
        .form-container:hover {
            transform: scale(1.02);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.7);
        }

        /* Dark input field with a hint of glow on hover and focus */
        .input-field {
            background: #333848;
            color: #f8f9fa;
            border: none;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .input-field:hover {
            background: #404658;
            transform: scale(1.01);
        }

        .input-field:focus {
            background: #404658;
            border-color: #fbbf24;
            box-shadow: 0 0 5px rgba(251, 191, 36, 0.6);
        }

        /* Halloween-themed button with a glowing effect */
        .btn-register {
            background: #fbbf24;
            color: #1e293b;
            border-radius: 0.5rem;
            transition: background 0.3s ease, box-shadow 0.3s ease, transform 0.2s ease;
            box-shadow: 0 4px 10px rgba(251, 191, 36, 0.4);
        }

        .btn-register:hover {
            background: #d97706;
            box-shadow: 0 6px 14px rgba(251, 191, 36, 0.5);
            transform: scale(1.03);
        }

        /* Link styling with a ghostly effect */
        .form-link {
            color: #a0aec0;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .form-link:hover {
            color: #fbbf24;
            text-shadow: 0 0 4px rgba(251, 191, 36, 0.7);
        }
    </style>
</head>

<x-guest-layout>
    <div class="max-w-md mx-auto p-8  form-container">
        <h2 class="text-3xl font-bold text-orange-500 text-center mb-8">Register</h2>

        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <x-input-label for="name" :value="__('Name')" class="text-yellow-400" />
                <x-text-input id="name"
                    class="input-field block w-full mt-1 rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500"
                    type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500" />
            </div>

            <!-- Email Address -->
            <div class="mb-4">
                <x-input-label for="email" :value="__('Email')" class="text-yellow-400" />
                <x-text-input id="email"
                    class="input-field block w-full mt-1 rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500"
                    type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <x-input-label for="password" :value="__('Password')" class="text-yellow-400" />
                <x-text-input id="password"
                    class="input-field block w-full mt-1 rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500"
                    type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
            </div>

            <!-- Confirm Password -->
            <div class="mb-6">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-yellow-400" />
                <x-text-input id="password_confirmation"
                    class="input-field block w-full mt-1 rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500"
                    type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500" />
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-between mt-4">
                <a class="form-link text-sm hover:text-yellow-400 transition duration-300" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button
                    class="btn-register font-semibold px-4 py-2 transition duration-300 focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>