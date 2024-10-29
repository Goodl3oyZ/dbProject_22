<x-guest-layout>
    <div class="max-w-md mx-auto p-8 bg-gray-800 rounded-lg shadow-lg mt-10">
        <h2 class="text-2xl font-bold text-yellow-400 text-center mb-6">Forgot Password</h2>

        <div class="mb-4 text-sm text-gray-400 text-center">
            {{ __('Forgot your password? No problem. Just let us know your email address, and we will email you a password reset link to choose a new one.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-6">
                <x-input-label for="email" :value="__('Email')" class="text-yellow-400" />
                <x-text-input id="email"
                    class="block w-full mt-1 bg-gray-700 text-white rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500"
                    type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-end">
                <x-primary-button
                    class="bg-yellow-500 hover:bg-yellow-400 text-gray-800 font-semibold px-4 py-2 rounded-md transition duration-300 focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                    {{ __('Email Password Reset Link') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>