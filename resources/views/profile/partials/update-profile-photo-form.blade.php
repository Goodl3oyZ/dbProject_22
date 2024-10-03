<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Photo') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your profile photo.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.photo.update') }}" enctype="multipart/form-data"
        class="mt-6 space-y-6">
        @csrf
        <div style=" display: flex; justify-content: center; align-items: center;" class="gap-4 p-4">
            <!-- phofile photo -->
            <div>
                <x-input-label for="current_photo" :value="__('Current Profile Photo')" />
                <div class="mt-1">
                    @if(Auth::user()->profile_photo)
                        <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Profile Photo"
                            class=" h-32 w-auto object-cover rounded-full" style="width: 8rem; height: 8rem;">
                    @else
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ __('No profile photo uploaded.') }}</p>
                    @endif
                </div>
            </div>
            <div class="flex flex-col gap-4 px-4"><!-- phofile photo choose -->
                <div>
                    <x-input-label for="profile_photo" :value="__('Profile Photo')" />
                    <input type="file" name="profile_photo" id="profile_photo"
                        class="mt-1 text-sm text-gray-600 dark:text-gray-400 w-full" />
                    <x-input-error class="mt-2" :messages="$errors->get('profile_photo')" />
                </div>
                <!-- save button -->
                <div class="flex items-center">
                    <x-primary-button>{{ __('Save') }}</x-primary-button>

                    @if (session('status') === 'profile-photo-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                            class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </form>


</section>