<head>
    <title>Human Shop</title>
    <link rel="icon" href="{{ asset('img/Logo.jpg') }}" type="image/jpeg">
    <style>
        /* Halloween Theme Colors */
        :root {
            --halloween-orange: #f97316;
            /* Spooky orange */
            --halloween-bg: #1f2937;
            /* Dark background for Halloween vibe */
            --halloween-gray: #2d3748;
            /* Dark gray */
            --halloween-text: #e2e8f0;
            /* Light text */
        }

        .halloween-card {
            background-color: var(--halloween-gray);
            border-color: var(--halloween-orange);
        }

        .halloween-text {
            color: var(--halloween-orange);
        }

        .halloween-btn {
            background-color: var(--halloween-orange);
            color: #1a202c;
        }

        .halloween-btn:hover {
            background-color: #ea580c;
        }
    </style>
    <style>
        /* Define keyframes for subtle floating effect */
        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        /* Apply animation */
        .floating-effect {
            animation: float 3s ease-in-out infinite;
        }
    </style>
</head>

<x-app-layout>
    <div class="container mx-auto px-6 py-8">

        <!-- Product Image and Information -->
        <div
            class="bg-gradient-to-r from-gray-800 to-gray-900 text-white p-10 rounded-lg shadow-lg mb-10 max-w-5xl mx-auto border border-gray-700 floating-effect">
            <h2 class="text-4xl font-bold text-center mb-6">{{ $product->productName }} - Reviews</h2>
            <div class="flex flex-col md:flex-row items-center justify-center md:space-x-10">

                <!-- Product Image -->
                <img src="{{ asset($product->products_photo) }}" alt="{{ $product->productName }}"
                    class="object-cover w-64 h-64 rounded-lg border-4 border-gray-700 shadow-lg mb-6 md:mb-0">

                <!-- Product Information -->
                <div class="text-center md:text-left space-y-3 md:max-w-md">
                    <div class="text-3xl font-semibold text-orange-300">{{ $product->productName }}</div>
                    <div class="text-lg text-gray-300">Price: ${{ number_format($product->price, 2) }}</div>
                    <div class="text-sm text-gray-400">In Stock: {{ $product->stockQuantity }}</div>
                    <p class="text-xl font-semibold mt-4">Average Rating:
                        <span class="text-yellow-400">{{ number_format($product->averageRating(), 1) }}/5</span>
                    </p>
                </div>
            </div>
        </div>



        <!-- Display all reviews with pagination -->
        <div class="space-y-8 max-w-2xl mx-auto">
            <div class="text-2xl font-semibold text-center halloween-text mb-8">Comments</div>
            <div class="border border-gray-700 rounded-lg overflow-hidden shadow-xl">

                @php
                    // กำหนดให้ $reviews เป็นคอมเมนต์ที่แบ่งหน้า
                    $reviews = $product->reviews()->paginate(4);
                @endphp

                @foreach ($reviews as $review)
                    <div class="bg-gradient-to-r from-gray-900 to-gray-800 p-6 border-b border-gray-700">
                        <div class="flex items-center mb-4">
                            <img src="{{ $review->user && $review->user->profile_photo ? asset('storage/' . $review->user->profile_photo) : asset('img/default_profile.png') }}"
                                alt="Profile Picture"
                                class="w-12 h-12 rounded-full mr-4 border-2 border-orange-500 shadow-lg object-cover">
                            <div class="flex flex-col">
                                <strong class="halloween-text text-lg">
                                    {{ $review->user ? $review->user->userName : 'Anonymous' }}
                                </strong>
                                <div class="flex items-center mt-1">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <svg class="w-5 h-5 {{ $i <= $review->rating ? 'text-orange-400' : 'text-gray-500' }} mr-1"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <p class="text-sm text-gray-300 leading-relaxed italic">
                            "{{ $review->comment }}"
                        </p>
                    </div>
                @endforeach
            </div>

            <!-- ลิงก์สำหรับการเปลี่ยนหน้าคอมเมนต์ -->
            <div class="mt-6 flex justify-center space-x-4">
                {{ $reviews->appends(request()->query())->links('pagination::tailwind') }}
            </div>




            @php
                $user = Auth::user();
                $orderCount = $user->order()->whereHas('products', function ($query) use ($product) {
                    $query->where('products.productId', $product->productId);
                })->count();

                $reviewCount = $user->review()->where('productId', $product->productId)->count();
                $canReview = $orderCount > 0 && $reviewCount < $orderCount;
            @endphp
            <!-- Add Review Form -->
            @if ($canReview)
                <div class="bg-gray-800 p-4 rounded-md shadow-md mb-8 max-w-md mx-auto mt-5">
                    <h3 class="text-md font-semibold halloween-text mb-3 text-center">Add Your Review</h3>

                    <form action="{{ route('humanShop.review.store', ['productId' => $product->productId]) }}"
                        method="POST">
                        @csrf

                        <!-- Alert Messages -->
                        @if(session('error'))
                            <div
                                class="bg-red-100 border border-red-300 text-red-700 px-3 py-2 rounded mb-3 text-center text-sm">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if(session('success'))
                            <div
                                class="bg-green-100 border border-green-300 text-green-700 px-3 py-2 rounded mb-3 text-center text-sm">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="bg-red-100 border border-red-300 text-red-700 px-3 py-2 rounded mb-3 text-sm">
                                <ul class="list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Rating -->
                        <div class="mb-3">
                            <label class="block halloween-text text-sm mb-1">Rating</label>
                            <div class="flex justify-center space-x-1 text-xl" id="star-rating-{{ $product->productId }}">
                                @for ($i = 1; $i <= 5; $i++)
                                    <input type="radio" name="rating_{{ $product->productId }}"
                                        id="rating_{{ $product->productId }}_{{ $i }}" value="{{ $i }}" class="hidden">
                                    <label for="rating_{{ $product->productId }}_{{ $i }}" class="cursor-pointer">
                                        <svg class="w-6 h-6 text-gray-400 star fill-current transition-all duration-200"
                                            data-rating="{{ $i }}" viewBox="0 0 20 20" fill="currentColor">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    </label>
                                @endfor
                            </div>
                        </div>

                        <script>
                            document.addEventListener('DOMContentLoaded', () => {
                                const stars = document.querySelectorAll('#star-rating-{{ $product->productId }} .star');

                                stars.forEach(star => {
                                    star.addEventListener('click', function () {
                                        const ratingValue = parseInt(this.getAttribute('data-rating'));
                                        document.getElementById(`rating_{{ $product->productId }}_${ratingValue}`).checked = true;
                                        highlightStars(ratingValue);
                                    });
                                });

                                function highlightStars(rating) {
                                    stars.forEach(star => {
                                        const starRating = parseInt(star.getAttribute('data-rating'));
                                        if (starRating <= rating) {
                                            star.classList.add('text-orange-500');
                                        } else {
                                            star.classList.remove('text-orange-500');
                                        }
                                    });
                                }
                            });
                        </script>

                        <!-- Comment -->
                        <div class="mb-3">
                            <label class="block halloween-text text-sm mb-1">Comment</label>
                            <textarea name="comment_{{ $product->productId }}"
                                class="bg-gray-700 text-white rounded-md px-3 py-2 w-full focus:ring-2 focus:ring-orange-500 text-sm"
                                rows="3" placeholder="Write your thoughts here..."></textarea>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="halloween-btn font-semibold px-4 py-2 rounded-md hover:bg-orange-600 w-full transition duration-300 text-sm">
                            Submit Review
                        </button>
                    </form>
                </div>
            @endif




            <!-- Back to Product Page -->
            <div class="mt-10 text-center">
                <a href="{{ route('humanShop.shoplist') }}"
                    class="halloween-text hover:underline transition duration-300">
                    Back to Products
                </a>
            </div>
        </div>
</x-app-layout>