<section class="space-y-10 p-10 bg-gradient-to-r from-gray-800 to-gray-900 rounded-2xl shadow-2xl">
    <header class="border-b border-gray-700 pb-6 mb-8">
        <h2 class="text-3xl font-bold text-orange-500">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-4 text-lg text-gray-400">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white px-6 py-3 rounded-full shadow-xl">
        {{ __('Delete Account') }}
    </x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}"
            class="p-8 bg-gray-900 rounded-2xl shadow-xl space-y-8">
            @csrf
            @method('delete')

            <h2 class="text-2xl font-bold text-orange-500">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-4 text-lg text-gray-400">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input id="password" name="password" type="password"
                    class="mt-4 block w-full p-4 bg-gray-800 text-gray-100 rounded-lg border-2 border-gray-700 focus:outline-none focus:ring-2 focus:ring-red-500"
                    placeholder="{{ __('Password') }}" />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-red-500" />
            </div>

            <div class="mt-8 flex justify-end gap-6">
                <x-secondary-button x-on:click="$dispatch('close')"
                    class="bg-gray-700 hover:bg-gray-600 text-white px-6 py-3 rounded-full shadow-md">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button
                    class="bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white px-6 py-3 rounded-full shadow-xl">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>