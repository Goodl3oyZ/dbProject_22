<head>
    <title>Human_shop</title>
    <link rel="icon" href="{{ asset('img/group21.jpg') }}" type="image/jpeg">
</head>

<x-app-layout>
    <div class="container mx-auto px-16 py-8 ">
        <div class="grid lg:grid-cols-4 md:grid-cols-2 sm:grid-cols-1 gap-8 max-w-6xl mx-auto">
            <!-- Display all products -->
            @foreach ($products as $product)
                <div
                    class="max-w-sm bg-gray-900 rounded-lg p-4 shadow-2xl text-center transition duration-300 hover:scale-105 transform border shadow-md mx-auto w-full">
                    <!-- Product Image -->
                    <img src="{{ asset($product->products_photo) }}" alt="{{ $product->productName }}"
                        class="object-cover w-32 h-32 mx-auto rounded-lg mb-4 border-2 border-yellow-500 shadow-md">

                    <!-- Product Information -->
                    <div class="text-left space-y-2">
                        <div class="text-xl font-semibold text-yellow-400">{{ $product->productName }}</div>
                        <div class="text-lg text-white ">Price: ${{ number_format($product->price, 2) }}</div>
                        <div class="text-sm text-gray-500">In Stock: {{ $product->stockQuantity }}</div>
                    </div>

                    <!-- Reviews Section -->
                    <div class="text-left text-gray-400 space-y-2">
                        <p class="text-sm text-gray-500">Average Rating: {{ number_format($product->averageRating(), 1) }}/5
                        </p>
                        <h3 class="text-lg font-semibold text-white cursor-pointer">
                            <a href="{{ route('humanShop.review', ['productId' => $product->productId]) }}"
                                class="hover:text-yellow-400 transition duration-300">Reviews</a>
                        </h3>
                    </div>

                    <!-- Add to Cart Section -->
                    <div class="flex justify-center">
                        <div class="mt-2 flex flex-col items-center">
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