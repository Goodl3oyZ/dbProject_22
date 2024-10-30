<head>
    <title>Human_shop</title>
    <link rel="icon" href="{{ asset('img/Logo.jpg') }}" type="image/jpeg">
</head>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-4 lg:px-6 grid grid-cols-1 md:grid-cols-2 gap-4 ">

            <!-- Profile Information -->
            <div class="p-4 bg-white dark:bg-gray-800 shadow-md rounded-md">
                <div class="max-w-lg border border-gray-700 rounded-md">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Change Profile Photo Component -->
            <div class="p-4 bg-white dark:bg-gray-800 shadow-md rounded-md">
                <div class="max-w-lg border border-gray-700 rounded-md">
                    @include('profile.partials.update-profile-photo-form')
                </div>
            </div>

            <!-- Update Password Component -->
            <div class="p-4 bg-white dark:bg-gray-800 shadow-md rounded-md">
                <div class="max-w-lg border border-gray-700 rounded-md">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete User Component -->
            <div class="p-4 bg-white dark:bg-gray-800 shadow-md rounded-md">
                <div class="max-w-lg border border-gray-700 rounded-md">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>