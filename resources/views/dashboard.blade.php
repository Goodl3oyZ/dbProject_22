<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Human_shop</title>
    <link rel="icon" href="{{ asset('img/group21.jpg') }}" type="image/jpeg">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 border border-gray-700 rounded-lg">
            <div
                class="bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="flex flex-col items-center justify-center p-8 text-white">
                    <p class="font-extrabold text-3xl mb-4">{{ __('Hello, ') . Auth::user()->userName }}</p>
                    <div class="p-4 sm:p-8 mb-6">
                        <div class="flex justify-center">
                            <img src="{{ Auth::user()->profile_photo ? asset('storage/' . Auth::user()->profile_photo) : asset('img/default_profile.png') }}"
                                alt="Profile Photo"
                                class="w-32 h-32 rounded-full border-4 border-yellow-500 object-cover">

                        </div>
                    </div>
                    <div class="text-center font-semibold text-lg max-w-2xl leading-relaxed">
                        <p>Welcome to <span class="text-yellow-500">Human Shop</span>, where we proudly present
                            everything related to secondhand human organs.</p>
                        <p>We are committed to providing you with comprehensive information and services to ensure you
                            have the best experience in selecting what meets your needs.</p>
                    </div>
                    <div class="mt-6 text-lg font-semibold text-yellow-500">
                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>