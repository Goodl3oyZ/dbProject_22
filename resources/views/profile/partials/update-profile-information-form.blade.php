<section
    class="p-10 bg-gradient-to-r from-gray-100 via-white to-gray-100 dark:from-gray-800 dark:via-gray-900 dark:to-gray-800 rounded-2xl shadow-2xl">
    <header class="border-b border-gray-300 dark:border-gray-700 pb-6 mb-8">
        <h2 class="text-3xl font-bold text-indigo-600 dark:text-yellow-500">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-4 text-lg text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>
    <div class="flex justify-center">
        <form method="post" action="{{ route('profile.update') }}"
            class="w-full max-w-3xl p-10 bg-white dark:bg-gray-800 shadow-2xl rounded-2xl space-y-8">
            @csrf
            @method('patch')
            <!-- name -->
            <div class="flex flex-col gap-4">
                <x-input-label for="userName" :value="__('Name')"
                    class="text-lg font-semibold text-gray-900 dark:text-gray-100" />
                <x-text-input id="userName" name="userName" type="text"
                    class="mt-4 block w-full text-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-lg shadow-md focus:ring-indigo-500 focus:border-indigo-500"
                    :value="old('userName', $user->userName)" required autofocus autocomplete="userName" />
                <x-input-error class="mt-2 text-red-500" :messages="$errors->get('userName')" />
            </div>
            <!-- Email -->
            <div class="flex flex-col gap-4">
                <x-input-label for="email" :value="__('Email')"
                    class="text-lg font-semibold text-gray-900 dark:text-gray-100" />
                <x-text-input id="email" name="email" type="email"
                    class="mt-4 block w-full text-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 rounded-lg shadow-md focus:ring-indigo-500 focus:border-indigo-500"
                    :value="old('email', $user->email)" required autocomplete="email" />
                <x-input-error class="mt-2 text-red-500" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                    <div class="mt-6">
                        <p class="text-md text-gray-800 dark:text-gray-200">
                            {{ __('Your email address is unverified.') }}

                            <button form="send-verification"
                                class="underline text-md text-indigo-600 dark:text-yellow-500 hover:text-indigo-800 dark:hover:text-yellow-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-4 font-medium text-md text-green-600 dark:text-green-400">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif

            </div>
            <!-- save button -->
            <div class="flex items-center gap-6 mt-8">
                <x-primary-button
                    class="text-lg px-8 py-4 bg-gradient-to-r from-indigo-500 via-indigo-600 to-indigo-700 hover:from-indigo-600 hover:to-indigo-800 dark:from-yellow-500 dark:via-yellow-600 dark:to-yellow-700 text-white rounded-full shadow-xl">
                    {{ __('Save') }}
                </x-primary-button>

                @if (session('status') === 'profile-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
                        class="text-md text-green-600 dark:text-green-400 font-semibold">{{ __('Saved.') }}</p>
                @endif
            </div>

        </form>
    </div>
</section>