<head>
    <title>Human_shop</title>
    <link rel="icon" href="{{ asset('img/group21.jpg') }}" type="image/jpeg">
</head>

<x-app-layout>
    <div class="container mx-auto px-6 py-8">
        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Display all products -->
            @foreach ($products as $product)
                    <div
                        class="bg-gray-900 rounded-lg p-6 shadow-2xl text-center transition duration-300 hover:scale-105 transform">
                        <!-- Product Image -->
                        <img src="{{ asset($product->products_photo) }}" alt="{{ $product->productName }}"
                            class="object-cover w-40 h-40 mx-auto rounded-lg mb-4 border-2 border-yellow-500 shadow-md">

                        <!-- Product Information -->
                        <div class="text-left space-y-2">
                            <div class="text-xl font-semibold text-gray-100">{{ $product->productName }}</div>
                            <div class="text-lg text-yellow-400">Price: ${{ number_format($product->price, 2) }}</div>
                            <div class="text-sm text-gray-500">In Stock: {{ $product->stockQuantity }}</div>
                        </div>

                        <!-- Reviews Section -->
                        <div class="mt-4 text-left text-gray-400 space-y-2">
                            <h3 class="text-lg font-semibold text-yellow-400">Reviews</h3>
                            <p>Average Rating: {{ number_format($product->averageRating(), 1) }}/5</p>
                            <a href="#" onclick="toggleReviews({{ $product->productId }})"
                                class="text-sm underline text-gray-400 hover:text-yellow-400 transition duration-300">Click to
                                view more reviews</a>

                            <!-- Toggle Reviews -->
                            <div id="reviews-{{ $product->productId }}" class="space-y-2 hidden">
                                @foreach ($product->reviews as $review)
                                    <div class="border-b border-gray-700 py-2">
                                        <strong
                                            class="text-white">{{ $review->user ? $review->user->userName : 'Anonymous' }}</strong>
                                        <span class="text-yellow-400">rated: {{ $review->rating }}/5</span>
                                        <p class="text-sm text-gray-400">{{ $review->comment }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Review Form -->
                        @auth
                                    @php
                                        $orderCount = Auth::user()->order()->whereHas('products', function ($query) use ($product) {
                                            $query->where('products.productId', $product->productId);
                                        })->count();
                                        $reviewCount = Auth::user()->review()->where('productId', $product->productId)->count();
                                    @endphp

                                    @if ($orderCount > 0 && $reviewCount < $orderCount)
                                        <form action="{{ route('products.review.store', $product->productId) }}" method="POST"
                                            class="mt-4 bg-gray-800 rounded-lg p-4 space-y-2 text-gray-400 shadow-inner">
                                            @csrf
                                            <h4 class="text-white text-lg">Leave a Review</h4>

                                            <label class="text-sm" for="rating_{{ $product->productId }}">Rating:</label>
                                            <select name="rating_{{ $product->productId }}" id="rating_{{ $product->productId }}"
                                                class="rounded-md bg-gray-900 text-white p-2 mb-2 w-full focus:border-yellow-500 focus:ring focus:ring-yellow-500"
                                                required>
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>

                                            <label class="text-sm" for="comment_{{ $product->productId }}">Comment:</label>
                                            <textarea name="comment_{{ $product->productId }}" id="comment_{{ $product->productId }}" rows="2"
                                                class="w-full bg-gray-900 text-white p-2 rounded-md resize-none focus:border-yellow-500 focus:ring focus:ring-yellow-500"></textarea>

                                            <button type="submit"
                                                class="w-full mt-2 bg-yellow-500 hover:bg-yellow-400 text-white font-semibold rounded-lg py-2 transition duration-300 ease-in-out">Submit
                                                Review</button>
                                        </form>
                                    @else
                                        <p class="text-gray-400 text-sm mt-2 underline">You can submit one review per purchase.</p>
                                    @endif
                        @else
                            <p class="text-gray-400 mt-4">Please <a href="{{ route('login') }}"
                                    class="text-yellow-400 hover:underline transition duration-300">log in</a> to leave a review.
                            </p>
                        @endauth

                        <!-- Add to Cart Section -->
                        <div class="mt-6 flex flex-col items-center">
                            <div class="flex items-center gap-4 w-full">
                                <label for="product-input-box-{{ $product->productId }}"
                                    class="text-gray-400 text-sm">Quantity:</label>

                                <!-- Quantity Input -->
                                <input type="number" id="product-input-box-{{ $product->productId }}"
                                    class="bg-gray-900 text-white rounded-lg px-4 py-2 w-20 outline-none focus:ring-2 focus:ring-yellow-500"
                                    placeholder="Qty" min="1" max="{{ $product->stockQuantity }}"
                                    onchange="checkStock({{ $product->productId }}, {{ $product->stockQuantity }})">

                                <!-- Stock Warning -->
                                <span id="stock-warning-{{ $product->productId }}" class="text-red-600 text-sm hidden">Not
                                    enough!</span>

                                <!-- Cart Button with New Icon -->
                                <a href="#" onclick="addToCart({{ $product->productId }})"
                                    class="w-12 h-12 flex items-center justify-center bg-yellow-500 hover:bg-yellow-400 rounded-full text-white transition duration-150 ease-in-out shadow-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" class="w-6 h-6 text-white">
                                        <g id="cart">
                                            <path fill="currentColor"
                                                d="M29.46 10.14A2.94 2.94 0 0 0 27.1 9H10.22L8.76 6.35A2.67 2.67 0 0 0 6.41 5H3a1 1 0 0 0 0 2h3.41a.68.68 0 0 1 .6.31l1.65 3 .86 9.32a3.84 3.84 0 0 0 4 3.38h10.37a3.92 3.92 0 0 0 3.85-2.78l2.17-7.82a2.58 2.58 0 0 0-.45-2.27zM28 11.86l-2.17 7.83A1.93 1.93 0 0 1 23.89 21H13.48a1.89 1.89 0 0 1-2-1.56L10.73 11H27.1a1 1 0 0 1 .77.35.59.59 0 0 1 .13.51z" />
                                            <circle fill="currentColor" cx="14" cy="26" r="2" />
                                            <circle fill="currentColor" cx="24" cy="26" r="2" />
                                        </g>
                                    </svg>
                                </a>
                            </div>
                        </div>

                    </div>
            @endforeach
        </div>
    </div>

    <script>
        function toggleReviews(productId) {
            const reviewsSection = document.getElementById('reviews-' + productId);
            reviewsSection.classList.toggle('hidden');
        }
        function checkStock(productId, stockQuantity) {
            const inputBox = document.getElementById('product-input-box-' + productId).value;
            const warning = document.getElementById('stock-warning-' + productId);
            if (inputBox > stockQuantity || inputBox <= 0) {
                warning.classList.remove('hidden');
            } else {
                warning.classList.add('hidden');
            }
        }

        function addToCart(productId) {
            const quantity = document.getElementById('product-input-box-' + productId).value;
            if (quantity > 0) {
                window.location.href = `/addtocart/${productId}/${quantity}`;
            } else {
                alert('Please enter a valid quantity');
            }
        }
    </script>
</x-app-layout>