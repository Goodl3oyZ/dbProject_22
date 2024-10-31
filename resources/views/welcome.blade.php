<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Human Shop - Quality Second-Hand Essentials</title>
    <link rel="icon" href="{{ asset('img/Logo.jpg') }}" type="image/jpeg">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* Background Animation */
        .bg-animated-gradient {
            background: linear-gradient(135deg, #141414, #1a1a1a, #262626);
            background-size: 300% 300%;
            animation: gradientAnimation 15s ease infinite;
        }

        @keyframes gradientAnimation {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        /* Button Hover Animation */
        .hover-bounce:hover {
            transform: scale(1.05);
        }

        /* Floating Animation */
        .floating {
            animation: floating 6s ease-in-out infinite;
        }

        @keyframes floating {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        /* Smooth Fade-in Animation */
        .fade-in {
            animation: fadeIn 2s ease-out;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(10px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="font-sans antialiased bg-gray-900 text-gray-200">
    <div class="min-h-screen">
        <!-- Header Section -->
        <header class="bg-gradient-to-r from-black via-gray-900 to-black border-b border-gray-700 shadow-md">
            <div class="container mx-auto flex items-center justify-between p-4 px-4 sm:px-6 md:px-8 lg:px-16 xl:px-24">
                <div class="flex items-center">
                    <img class="h-8 w-8 md:h-10 md:w-10 shadow-lg" src="{{ asset('img/Logo.jpg') }}" alt="Human Shop">
                    <span class="ml-2 text-lg md:text-xl font-bold text-orange-500 tracking-wide floating">Human
                        Shop</span>
                </div>
                @if (Route::has('login'))
                    <nav class="flex gap-2 md:gap-3">
                        @auth
                            <a href="{{ url('/dashboard') }}"
                                class="px-3 py-1 text-xs md:text-sm border border-orange-500 text-orange-500 rounded-lg hover:bg-orange-500 hover:text-gray-900 transition hover-bounce">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="px-3 py-1 text-xs md:text-sm border border-orange-500 text-orange-500 rounded-lg hover:bg-orange-500 hover:text-gray-900 transition hover-bounce">
                                Log in
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="px-3 py-1 text-xs md:text-sm border border-orange-500 text-orange-500 rounded-lg hover:bg-orange-500 hover:text-gray-900 transition hover-bounce">
                                    Register
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </div>
        </header>

        <!-- Hero Section -->
        <section class="bg-animated-gradient h-screen flex items-center justify-center relative overflow-hidden">
            <img src="{{ asset('img/halloween.jpg') }}" alt="Background Image"
                class="absolute inset-0 w-full h-full object-cover opacity-40 fade-in">
            <div class="text-center bg-black bg-opacity-60 p-6 rounded-lg z-10 fade-in">
                <h1 class="text-4xl font-bold text-orange-500 mb-3 floating">Welcome to Human Shop</h1>
                <p class="text-base text-gray-300 mb-4">Discover high-quality, second-hand essentials at affordable
                    prices.</p>
                <a href="#products"
                    class="px-4 py-2 bg-orange-500 text-gray-900 font-semibold rounded-lg hover:bg-orange-600 transition hover-bounce">
                    Explore Our Collection
                </a>
            </div>
        </section>

        <!-- Product Section -->
        <main class="container mx-auto p-6">
            <section id="products" class="fade-in">
                <h2 class="text-3xl font-bold text-orange-500 mb-4">Top-Rated Products</h2>
                <p class="text-sm text-gray-400 mb-8">Our carefully curated selection ensures reliability and quality
                    you can trust.</p>
                <div class="flex overflow-x-auto space-x-4 p-4 items-center justify-center">
                    <div class="grid grid-cols-4 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        @foreach($topRatedProducts as $product)
                            <div
                                class="bg-gray-800 border border-gray-700 rounded-lg overflow-hidden shadow-md transform transition-all duration-300 hover:scale-105 hover:shadow-xl group max-w-xs flex-shrink-0">
                                <div class="overflow-hidden h-40 w-full">
                                    <img class="h-full w-full object-cover transform transition-transform duration-300 group-hover:scale-110"
                                        src="{{ asset($product->products_photo) }}" alt="{{ $product->productName }}">
                                </div>
                                <div class="p-3">
                                    <h3 class="text-sm font-semibold text-orange-500 mb-1">{{ $product->productName }}</h3>
                                    <p class="text-xs text-gray-400 mb-2">
                                        {{ $product->description ?? 'High-quality, pre-loved product' }}
                                    </p>
                                    <p class="text-xs text-gray-300 flex items-center mb-2">
                                        <span class="font-semibold mr-1">Rating:</span>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <svg class="w-3 h-3 {{ $i <= floor($product->average_rating) ? 'text-orange-500' : 'text-gray-400' }}"
                                                fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927a.75.75 0 011.414 0l1.796 3.64 4.02.583a.75.75 0 01.416 1.279l-2.907 2.833.686 4.005a.75.75 0 01-1.086.79L10 13.348l-3.598 1.89a.75.75 0 01-1.086-.79l.686-4.005L3.095 8.43a.75.75 0 01.416-1.279l4.02-.583L9.049 2.927z" />
                                            </svg>
                                        @endfor
                                    </p>
                                    <a href="{{ route('humanShop.shoplist') }}"
                                        class="text-xs text-orange-500 font-semibold hover:text-orange-400 transition">Learn
                                        More</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="flex justify-center items-center mt-8">
                    <a href="{{ route('humanShop.shoplist') }}"
                        class="text-lg text-orange-500 font-semibold relative group flex items-center gap-1 hover-bounce">
                        Browse All Products
                        <svg class="w-4 h-4 text-orange-500 transition-transform group-hover:translate-x-1"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </section>
        </main>
    </div>
    <section class="bg-gray-800 p-6 text-center">
        <h2 class="text-3xl font-bold text-orange-500 mb-4">What Our Customers Say</h2>
        <p class="text-sm text-gray-400 max-w-2xl mx-auto mb-6">We’re proud to serve our customers with
            top-notch products and excellent service.</p>
        <div class="flex flex-wrap justify-center gap-4">
            <div class="bg-gray-700 border border-gray-600 rounded-lg p-4 shadow-md max-w-xs">
                <p class="text-orange-400 font-semibold mb-1">"Exceptional quality and fast shipping!"</p>
                <p class="text-gray-300 text-xs">— John D., Verified Buyer</p>
            </div>
            <div class="bg-gray-700 border border-gray-600 rounded-lg p-4 shadow-md max-w-xs">
                <p class="text-orange-400 font-semibold mb-1">"The customer support was incredibly helpful."</p>
                <p class="text-gray-300 text-xs">— Sarah W., Satisfied Customer</p>
            </div>
            <div class="bg-gray-700 border border-gray-600 rounded-lg p-4 shadow-md max-w-xs">
                <p class="text-orange-400 font-semibold mb-1">"A truly unique shopping experience."</p>
                <p class="text-gray-300 text-xs">— Mike L., Loyal Shopper</p>
            </div>
        </div>
    </section>

    <!-- Promotion Section -->
    <section class="bg-orange-600 text-gray-900 text-center py-8">
        <h2 class="text-3xl font-bold mb-4">Exclusive Welcome Offer!</h2>
        <p class="text-lg font-semibold mb-4">Enjoy a surprise discount of up to 30% on your first purchase!</p>
        <a href="{{ route('humanShop.shoplist') }}"
            class="px-4 py-2 bg-gray-800 text-orange-500 font-semibold rounded-lg hover:bg-gray-700 transition">Start
            Shopping Now</a>
    </section>


</body>
<!-- Footer Section -->
<footer class="bg-gray-900 text-center text-xs text-gray-400 py-4 border-t border-gray-700">
    <p>&copy; 2024 Human Shop. All rights reserved.</p>
    <p>Contact us: <a href="mailto:fifa888@humanshop.com" class="hover:text-orange-500">fifa888@humanshop.com</a> |
        Phone: <a href="tel:+660622122468" class="hover:text-orange-500">062 2122468</a></p>
</footer>

</html>