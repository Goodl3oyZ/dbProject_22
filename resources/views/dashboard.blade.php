<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Human_shop</title>
    <link rel="icon" href="{{ asset('img/Logo.jpg') }}" type="image/jpeg">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* Floating animation */
        .floating {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-5px);
            }
        }

        /* Pulse animation for text */
        .pulse-text {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.8;
            }
        }

        /* Button hover bounce */
        .hover-bounce:hover {
            transform: scale(1.05);
        }

        /* Subtle bounce animation for icons */
        .icon-bounce {
            animation: iconBounce 1.5s infinite;
        }

        @keyframes iconBounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-3px);
            }
        }
    </style>
</head>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-orange-500 leading-tight pulse-text">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12 bg-cover bg-center" style="background-image: url('{{ asset('img/dashboard_bg.jpg') }}');">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 rounded-lg ">
            <div
                class="bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 overflow-hidden shadow-lg sm:rounded-lg border border-gray-700">
                <div class="flex flex-col items-center justify-center p-10 text-gray-300">

                    <!-- Welcome Message with Icon -->
                    <p class="font-extrabold text-3xl mb-6 text-orange-500 flex items-center gap-3 floating">
                        <span>👋</span> {{ __('Welcome, ') . Auth::user()->userName }}!
                    </p>

                    <!-- Profile Photo Section with Name Overlay -->
                    <div class="relative p-4 sm:p-8 mb-6 floating">
                        <div class="flex justify-center relative">
                            <img src="{{ Auth::user()->profile_photo ? asset('storage/' . Auth::user()->profile_photo) : asset('img/default_profile.png') }}"
                                alt="Profile Photo"
                                class="w-32 h-32 rounded-full border-4 border-orange-500 object-cover shadow-md hover:scale-110 transition-transform duration-500">
                            <div
                                class="absolute bottom-0 left-0 right-0 bg-gray-800 bg-opacity-75 rounded-b-full text-orange-300 font-semibold py-1 text-sm text-center">
                                {{ Auth::user()->userName }}
                            </div>
                        </div>
                    </div>

                    <!-- Welcome Text and Intro with Animated Icon -->
                    <div class="text-center font-semibold text-lg max-w-2xl leading-relaxed text-gray-300 mb-6">
                        <p>Welcome to <span class="text-orange-500">Human Shop</span>! We're thrilled to have you here.
                        </p>
                        <p class="flex items-center justify-center gap-2 mt-2 icon-bounce">

                            Explore our unique catalog of secondhand human organs, carefully curated for your needs. Our
                            goal is to offer a safe, transparent, and informative experience to help you find exactly
                            what you're looking for.
                        </p>
                    </div>

                    <!-- Suggestions or Links to Explore More with Icons -->
                    <div class="flex gap-6 justify-center mt-6">
                        <a href="{{ route('humanShop.shoplist') }}"
                            class="px-5 py-3 bg-orange-600 text-white rounded-lg font-medium shadow-md hover:bg-orange-500 transition-transform transform hover:scale-105 flex items-center gap-2 hover-bounce">
                            🛒 Browse Products
                        </a>
                        <a href="{{ route('profile.edit') }}"
                            class="px-5 py-3 bg-gray-700 text-orange-500 rounded-lg font-medium shadow-md hover:bg-gray-600 transition-transform transform hover:scale-105 flex items-center gap-2 hover-bounce">
                            👤 View Profile
                        </a>
                        <a href="{{ route('orders.index') }}"
                            class="px-5 py-3 bg-gray-700 text-orange-500 rounded-lg font-medium shadow-md hover:bg-gray-600 transition-transform transform hover:scale-105 flex items-center gap-2 hover-bounce">
                            📦 My Orders
                        </a>
                    </div>

                    <!-- Logged In Confirmation with Icon -->
                    <div class="mt-10 text-lg font-semibold text-orange-500 flex items-center gap-2 pulse-text">
                        <span>✅</span> {{ __('You are successfully logged in! Enjoy exploring Human Shop.') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>