<section class="p-10 bg-gradient-to-r from-gray-800 to-gray-900 rounded-2xl shadow-2xl">
    <header class="border-b border-gray-700 pb-6 mb-8">
        <h2 class="text-3xl font-bold text-orange-500">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-4 text-lg text-gray-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}"
        class="space-y-4 bg-gray-800 p-8 rounded-2xl shadow-xl  border border-gray-700">
        @csrf
        @method('put')

        <div class="flex flex-col gap-2">
            <div>
                <x-input-label for="update_password_current_password" :value="__('Current Password')"
                    class="text-base font-semibold text-gray-400" />
                <x-text-input id="update_password_current_password" name="current_password" type="password"
                    class="mt-1 block w-full p-2 bg-gray-800 text-gray-100 rounded-lg border-2 border-gray-700 focus:outline-none focus:ring-2 focus:ring-orange-500"
                    autocomplete="current-password" />
                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-1 text-red-500" />
            </div>

            <div>
                <x-input-label for="update_password_password" :value="__('New Password')"
                    class="text-base font-semibold text-gray-400" />
                <x-text-input id="update_password_password" name="password" type="password"
                    class="mt-1 block w-full p-2 bg-gray-800 text-gray-100 rounded-lg border-2 border-gray-700 focus:outline-none focus:ring-2 focus:ring-orange-500"
                    autocomplete="new-password" />
                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-1 text-red-500" />
            </div>

            <div>
                <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')"
                    class="text-base font-semibold text-gray-400" />
                <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password"
                    class="mt-1 block w-full p-2 bg-gray-800 text-gray-100 rounded-lg border-2 border-gray-700 focus:outline-none focus:ring-2 focus:ring-orange-500"
                    autocomplete="new-password" />
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')"
                    class="mt-1 text-red-500" />
            </div>
        </div>

        <div class="flex items-center gap-6">
            <x-primary-button
                class="bg-gradient-to-r from-orange-400 via-orange-500 to-orange-600 hover:from-orange-500 hover:to-orange-700 text-black px-6 py-3 rounded-full shadow-xl">
                {{ __('Save') }}
            </x-primary-button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
                    class="text-md text-orange-500 font-semibold">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>