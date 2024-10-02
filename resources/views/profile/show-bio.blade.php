<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Bio') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Form to edit bio -->
                    <form method="post" action="{{ route('profile.update-bio') }}" class="mt-6 space-y-6">
                        @csrf
                        @method('patch')

                        <div>
                            <x-input-label for="bio" />
                            <textarea id="bio" name="bio" rows="5"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-100"
                                required>{{ old('bio', $bio->bio ?? '') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('bio')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Update Bio') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if (session('status'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '{{ session('status') }}',
                    confirmButtonText: 'OK'
                });
            @endif
        });
    </script>
    <div class="py-6">
        <center>
            <!-- Back to Previous Page Button -->
            <x-secondary-button onclick="disableFormSubmissionAndGoBack()">
                {{ __('Back to Previous') }}
            </x-secondary-button>
        </center>
    </div>

    <script>
        // Function to toggle the visibility of the intensity input
        function toggleIntensityInput(emotionId) {
            var checkbox = document.getElementById('emotion_' + emotionId);
            var intensityContainer = document.getElementById('intensity_container_' + emotionId);

            // Show intensity input if checkbox is checked
            if (checkbox.checked) {
                intensityContainer.classList.remove('hidden');
            } else {
                intensityContainer.classList.add('hidden');
            }
        }

        function disableFormSubmissionAndGoBack() {
            window.onbeforeunload = null; // Disable any beforeunload alert.
            window.history.back(); // Navigate back to the previous page.
        }
    </script>

</x-app-layout>