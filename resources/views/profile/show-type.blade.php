<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit PersonalType') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Form to edit personality type -->
                    <form method="post" action="{{ route('profile.update-type') }}" class="mt-6 space-y-6">
                        @csrf
                        @method('patch')

                        <div>
    <x-input-label for="personality_type_id" value="{{ __('Personality Type') }}" />
    <select id="personality_type_id" name="personality_type_id"
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-100">
        @foreach ($personalityTypes as $type)
            <option value="{{ $type->id }}" 
                    data-description="{{ $type->description }}" 
                    {{ old('personality_type_id', $user->personality_id) == $type->id ? 'selected' : '' }}>
                {{ $type->type }}
            </option>
        @endforeach
    </select>
    <x-input-error class="mt-2" :messages="$errors->get('personality_type_id')" />
</div>

<div id="personality-description" class="mt-2 text-gray-600 dark:text-gray-400">
    <!-- จะมีการแสดงรายละเอียดของ personality type ที่เลือกตรงนี้ -->
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
<script>
    // JavaScript เพื่อแสดง description เมื่อเปลี่ยน option
    document.addEventListener('DOMContentLoaded', function() {
        const selectElement = document.getElementById('personality_type_id');
        const descriptionElement = document.getElementById('personality-description');

        // ฟังก์ชันเพื่ออัปเดต description
        function updateDescription() {
            const selectedOption = selectElement.options[selectElement.selectedIndex];
            const description = selectedOption.getAttribute('data-description');
            descriptionElement.textContent = description ? description : 'No description available.';
        }

        // เรียกใช้ฟังก์ชันเมื่อเปลี่ยน option
        selectElement.addEventListener('change', updateDescription);

        // เรียกใช้ฟังก์ชันเมื่อโหลดหน้าเว็บ เพื่อแสดง description ของ option ที่ถูกเลือกตั้งแต่แรก
        updateDescription();
    });
</script>



                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Update Type') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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