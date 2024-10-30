<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Human_shop</title>
    <link rel="icon" href="{{ asset('img/Logo.jpg') }}" type="image/jpeg">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .card-hover:hover {
            transform: scale(1.05) rotate(1deg);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.4);
        }

        .fade-in {
            opacity: 0;
            animation: fadeIn 1s ease-in-out forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }
    </style>
</head>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-orange-500 leading-tight text-center">
            {{ __('Member Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-900 shadow-lg rounded-lg overflow-hidden fade-in">
                <div class="p-10 grid grid-cols-1 sm:grid-cols-3 gap-8">

                    <!-- Card 1 -->
                    <div
                        class="bg-gradient-to-br from-gray-800 to-gray-900 p-6 rounded-lg shadow-lg hover:shadow-2xl transition-all duration-300 text-center border border-gray-700 card-hover">
                        <img src="{{ asset('img/ภาณุเดช.jpg') }}" alt="Person 1"
                            class="w-32 h-32 mx-auto rounded-full mb-4 border-4 border-orange-500 shadow-md transform transition-transform duration-300 hover:scale-110">
                        <h3 class="text-2xl font-bold text-orange-500 mb-2">นายภาณุเดช เสือเผือก</h3>
                        <p class="text-gray-400 text-lg font-medium">Student ID: 650610797</p>
                        <p class="text-gray-500 text-sm mt-2">Email: panudetzx2@gmail.com</p>
                    </div>

                    <!-- Card 2 -->
                    <div
                        class="bg-gradient-to-br from-gray-800 to-gray-900 p-6 rounded-lg shadow-lg hover:shadow-2xl transition-all duration-300 text-center border border-gray-700 card-hover">
                        <img src="{{ asset('img/ภูเบศร์.jpg') }}" alt="Person 2"
                            class="w-32 h-32 mx-auto rounded-full mb-4 border-4 border-orange-500 shadow-md transform transition-transform duration-300 hover:scale-110">
                        <h3 class="text-2xl font-bold text-orange-500 mb-2">นายภูเบศร์ เรืองคุ้ม</h3>
                        <p class="text-gray-400 text-lg font-medium">Student ID: 650610798</p>
                        <p class="text-gray-500 text-sm mt-2">Email: pubestpubest@gmail.com</p>
                    </div>

                    <!-- Card 3 -->
                    <div
                        class="bg-gradient-to-br from-gray-800 to-gray-900 p-6 rounded-lg shadow-lg hover:shadow-2xl transition-all duration-300 text-center border border-gray-700 card-hover">
                        <img src="{{ asset('img/อนวัช.jpg') }}" alt="Person 3"
                            class="w-32 h-32 mx-auto rounded-full mb-4 border-4 border-orange-500 shadow-md transform transition-transform duration-300 hover:scale-110">
                        <h3 class="text-2xl font-bold text-orange-500 mb-2">นายอนวัช รัตนกิจศร</h3>
                        <p class="text-gray-400 text-lg font-medium">Student ID: 650610818</p>
                        <p class="text-gray-500 text-sm mt-2">Email: janawat0123@gmail.com</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>