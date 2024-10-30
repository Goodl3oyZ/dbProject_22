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
</head>

<x-app-layout>
    <div class="container mx-auto px-6 py-8">

        <!-- Product Image and Information -->
        <h2 class="text-3xl font-bold halloween-text mb-10 text-center">{{ $product->productName }} - Reviews</h2>
        <div class="flex justify-center">
            <div class="flex flex-col items-center mb-10 border halloween-card rounded-lg p-4 max-w-lg px-8">
                <img src="{{ asset($product->products_photo) }}" alt="{{ $product->productName }}"
                    class="object-cover w-48 h-48 rounded-lg border-4 halloween-text shadow-lg mb-6">
                <div class="text-center space-y-2">
                    <div class="text-2xl font-semibold halloween-text">{{ $product->productName }}</div>
                    <div class="text-lg text-white">Price: ${{ number_format($product->price, 2) }}</div>
                    <div class="text-sm text-gray-500">In Stock: {{ $product->stockQuantity }}</div>
                </div>
                <p class="text-center text-xl font-semibold halloween-text">Average Rating:
                    {{ number_format($product->averageRating(), 1) }}/5
                </p>
            </div>
        </div>

        <!-- Display all reviews -->
        <div class="space-y-8 max-w-2xl mx-auto">
            <div class="text-2xl halloween-text">Comments</div>
            <div class="border gap-5 rounded-lg">
                @foreach ($product->reviews as $review)
                    <div class="bg-gray-800 p-6 rounded-lg shadow-lg border border-gray-200 m-5">
                        <div class="flex items-center mb-2">
                            <img src="{{ $review->user && $review->user->profile_photo ? asset('storage/' . $review->user->profile_photo) : asset('img/default_profile.png') }}"
                                alt="Profile Picture"
                                class="w-10 h-10 rounded-full mr-3 object-cover border halloween-text">
                            <strong class="halloween-text text-lg">
                                {{ $review->user ? $review->user->userName : 'Anonymous' }}
                            </strong>
                            <span class="ml-4 flex items-center">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg class="w-5 h-5 {{ $i <= $review->rating ? 'halloween-text' : 'text-gray-400' }}"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                @endfor
                            </span>
                        </div>
                        <p class="text-sm text-white">{{ $review->comment }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Add Review Form -->
        <div class="bg-gray-800 p-8 rounded-lg shadow-xl mb-12 max-w-lg mx-auto mt-5">
            <h3 class="text-xl font-semibold halloween-text mb-6 text-center">Add Your Review</h3>

            @php
                $user = Auth::user();
                $orderCount = $user->order()->whereHas('products', function ($query) use ($product) {
                    $query->where('products.productId', $product->productId);
                })->count();

                $reviewCount = $user->review()->where('productId', $product->productId)->count();
                $canReview = $orderCount > 0 && $reviewCount < $orderCount;
            @endphp

            @if(!$canReview)
                <div class="bg-gray-700 p-4 rounded-lg text-center mb-4">
                    @if($orderCount === 0)
                        <p class="halloween-text">You need to purchase this product before leaving a review.</p>
                    @else
                        <p class="halloween-text">You have already submitted the maximum number of reviews for this product.</p>
                    @endif
                </div>
            @else
                <form action="{{ route('humanShop.review.store', ['productId' => $product->productId]) }}" method="POST">
                    @csrf

                    <!-- Alert Messages -->
                    @if(session('error'))
                        <div class="bg-red-200 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 text-center">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="bg-green-200 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 text-center">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="bg-red-200 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Rating -->
                    <div class="mb-6">
                        <label class="block halloween-text mb-2">Rating</label>
                        <select name="rating_{{ $product->productId }}"
                            class="bg-gray-700 text-white rounded px-4 py-2 w-full focus:ring-2 focus:ring-orange-500">
                            @for ($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <!-- Comment -->
                    <div class="mb-6">
                        <label class="block halloween-text mb-2">Comment</label>
                        <textarea name="comment_{{ $product->productId }}"
                            class="bg-gray-700 text-white rounded px-4 py-2 w-full focus:ring-2 focus:ring-orange-500"
                            rows="3"></textarea>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="halloween-btn font-semibold px-6 py-2 rounded-lg hover:bg-orange-600 w-full transition duration-300">
                        Submit Review
                    </button>
                </form>
            @endif
        </div>

        <!-- Back to Product Page -->
        <div class="mt-10 text-center">
            <a href="{{ route('humanShop.shoplist') }}" class="halloween-text hover:underline transition duration-300">
                Back to Products
            </a>
        </div>
    </div>
</x-app-layout>