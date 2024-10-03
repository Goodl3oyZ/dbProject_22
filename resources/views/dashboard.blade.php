<head>
    <title>Human_shop</title>
    <link rel="icon" href="{{ asset('img/group21.jpg') }}" type="image/jpeg">
</head>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex flex-col items-center justify-center p-6 text-gray-900 dark:text-gray-100">
                    <p2 class="font-extrabold text-2xl"> {{ __("Hello , ") . Auth::user()->userName }} </p2>
                    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                        <div class="max-w-xl ">
                            <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Profile Photo"
                                class=" w-20 h-20 rounded-full">
                        </div>
                    </div>
                    <div class="font-extrabold "
                        style="display: flex; justify-content: center; align-items: center; flex-direction: column;">
                        <div>Welcome to Human Shop, where we proudly present everything related to secondhand human
                            organs.</div>
                        <div>We are committed to providing you with comprehensive information and services to ensure you
                            have
                            the best experience in selecting what meets your needs.</div>
                    </div>

                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>


</x-app-layout>