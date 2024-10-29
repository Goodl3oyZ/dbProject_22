<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-yellow-400 leading-tight text-center">
            {{ __('Member Profile') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 shadow-lg rounded-lg overflow-hidden">
                <div class="p-10 grid grid-cols-1 sm:grid-cols-3 gap-8">

                    <!-- Card 1 -->
                    <div class="bg-gray-800 p-6 rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300 text-center border border-gray-700">
                        <img src="{{ asset('img/ภาณุเดช.jpg') }}" alt="Person 1"
                            class="w-32 h-32 mx-auto rounded-full mb-4 border-4 border-yellow-400 shadow-md">
                        <h3 class="text-2xl font-bold text-yellow-400 mb-2">นายภาณุเดช เสือเผือก</h3>
                        <p class="text-gray-400 text-lg font-medium">รหัสนักศึกษา: 650610797</p>
                        <p class="text-gray-500 text-sm mt-2">อีเมล: panudetzx2@gmail.com</p>
                    </div>

                    <!-- Card 2 -->
                    <div class="bg-gray-800 p-6 rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300 text-center border border-gray-700">
                        <img src="{{ asset('img/ภูเบศร์.jpg') }}" alt="Person 2"
                            class="w-32 h-32 mx-auto rounded-full mb-4 border-4 border-yellow-400 shadow-md">
                        <h3 class="text-2xl font-bold text-yellow-400 mb-2">นายภูเบศร์ เรืองคุ้ม</h3>
                        <p class="text-gray-400 text-lg font-medium">รหัสนักศึกษา: 650610798</p>
                        <p class="text-gray-500 text-sm mt-2">อีเมล: pubestpubest@gmail.com</p>
                    </div>

                    <!-- Card 3 -->
                    <div class="bg-gray-800 p-6 rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300 text-center border border-gray-700">
                        <img src="{{ asset('img/อนวัช.jpg') }}" alt="Person 3"
                            class="w-32 h-32 mx-auto rounded-full mb-4 border-4 border-yellow-400 shadow-md">
                        <h3 class="text-2xl font-bold text-yellow-400 mb-2">นายอนวัช รัตนกิจศร</h3>
                        <p class="text-gray-400 text-lg font-medium">รหัสนักศึกษา: 650610818</p>
                        <p class="text-gray-500 text-sm mt-2">อีเมล: janawat0123@gmail.com</p>
                    </div>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
