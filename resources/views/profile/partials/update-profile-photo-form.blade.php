<section class="p-10 bg-gradient-to-r from-gray-800 to-gray-900 rounded-2xl shadow-2xl">
    <header class="border-b border-gray-700 pb-6 mb-8">
        <h2 class="text-3xl font-bold text-yellow-500">
            {{ __('Profile Photo') }}
        </h2>

        <p class="mt-4 text-lg text-gray-400">
            {{ __('Update your profile photo.') }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.photo.update') }}" enctype="multipart/form-data"
        class="space-y-8 bg-gray-900 p-8 rounded-2xl shadow-xl">
        @csrf
        <div class="flex flex-col items-center">
            <x-input-label for="current_photo" :value="__('Current Profile Photo')"
                class="text-lg font-semibold text-gray-400 text-center" />
            <div class="mt-6 flex justify-center">
                <img src="{{ Auth::user()->profile_photo ? asset('storage/' . Auth::user()->profile_photo) : asset('img/default_profile.png') }}"
                    alt="Profile Photo"
                    class="h-40 w-40 object-cover rounded-full border-4 border-yellow-500 shadow-lg">
            </div>

        </div>
        <div class="flex flex-col lg:flex-row justify-center items-center gap-12">
            <!-- Profile Photo Choose -->
            <div class="flex flex-col items-center">
                <div>
                    <x-input-label for="profile_photo" :value="__('Profile Photo')"
                        class="text-lg font-semibold text-gray-400" />
                    <input type="file" name="profile_photo" id="profile_photo"
                        class="mt-4 text-md text-gray-400 bg-gray-800 border-2 border-yellow-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 w-full p-2" />
                    <x-input-error class="mt-2 text-red-500" :messages="$errors->get('profile_photo')" />
                </div>
                <!-- Save Button -->
                <div class="flex items-center gap-6 mt-6">
                    <x-primary-button
                        class="bg-gradient-to-r from-yellow-400 via-yellow-500 to-yellow-600 hover:from-yellow-500 hover:to-yellow-700 text-black px-6 py-3 rounded-full shadow-xl">
                        {{ __('Save') }}
                    </x-primary-button>
                    @if (session('status') === 'profile-photo-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
                            class="text-md text-yellow-500 font-semibold">
                            {{ __('Saved.') }}
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </form>
</section>