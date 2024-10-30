<head>
    <title>Human Shop</title>
    <link rel="icon" href="{{ asset('img/Logo.jpg') }}" type="image/jpeg">
    <style>
        /* Halloween Orange */
        :root {
            --orange-halloween: #f97316;
            /* Spooky orange */
            --dark-bg: #1e293b;
            /* Dark background for Halloween theme */
            --light-gray: #e5e7eb;
            /* Light gray text for readability */
        }

        /* Container styling for each product */
        .product-card {
            background-color: var(--dark-bg);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 0.75rem;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.4);
        }

        .product-card:hover {
            transform: scale(1.05);
            box-shadow: 0px 15px 30px rgba(0, 0, 0, 0.5);
        }

        /* Input field styling for quantity */
        .input-field {
            background: #333848;
            color: var(--light-gray);
            border: none;
            transition: background 0.3s ease;
        }

        .input-field:focus {
            background: #404658;
            box-shadow: 0 0 5px rgba(249, 115, 22, 0.6);
            /* Orange glow */
        }

        /* Button styling with orange hover effect */
        .btn-orange {
            background-color: var(--orange-halloween);
            color: var(--dark-bg);
            border-radius: 0.5rem;
            transition: background 0.3s ease, transform 0.2s ease;
            box-shadow: 0 4px 10px rgba(249, 115, 22, 0.3);
        }

        .btn-orange:hover {
            background-color: #ea580c;
            transform: scale(1.05);
            box-shadow: 0 6px 14px rgba(249, 115, 22, 0.4);
        }

        /* SVG icons with orange theme */
        .icon-orange {
            color: var(--orange-halloween);
            transition: transform 0.2s ease;
        }

        .icon-orange:hover {
            transform: scale(1.2);
        }
    </style>
</head>

<x-app-layout>
    <div class="container mx-auto px-16 py-8">

        <!-- Search Box -->
        <div class="flex justify-center mb-8">
            <form action="{{ route('humanShop.search') }}" method="GET" class="w-full max-w-md">
                <div class="relative flex items-center">
                    <!-- Search Input Box -->
                    <input type="text" name="query" placeholder="Search for products..."
                        class="w-full bg-gray-800 text-white rounded-lg py-3 px-4 pl-10 border border-gray-700 focus:ring-2 focus:ring-orange-500 focus:outline-none"
                        value="{{ request('query') }}">

                    <!-- Icon Button for Quick Search -->
                    <button type="submit"
                        class="absolute left-2 top-1/2 transform -translate-y-1/2 text-orange-500 hover:text-orange-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M12.9 14.32a8 8 0 111.414-1.414l4.95 4.95a1 1 0 01-1.414 1.414l-4.95-4.95zM8 14a6 6 0 100-12 6 6 0 000 12z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>

                    <!-- Text Button for Full Search -->
                    <button type="submit"
                        class="ml-4 px-4 py-3 bg-orange-500 hover:bg-orange-400 text-white rounded-lg transition duration-150 ease-in-out">
                        Search
                    </button>
                </div>
            </form>
        </div>

        <!-- Sorting Section -->
        <form action="{{ route('humanShop.index') }}" method="GET" class="flex items-center space-x-3">
            <label for="sort" class="text-gray-300 font-semibold">Sort By:</label>
            <div class="relative px-3">
                <select name="sort" id="sort"
                    class="appearance-none bg-gray-900 text-orange-400 font-semibold rounded-full py-2 px-6 border border-orange-500 focus:ring-2 focus:ring-orange-500 transition duration-200 ease-in-out shadow-lg hover:shadow-xl cursor-pointer"
                    onchange="this.form.submit()">
                    <option value="">Default</option>
                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High
                    </option>
                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low
                    </option>
                    <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name: A-Z</option>
                    <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name: Z-A</option>
                </select>
            </div>
        </form>

        <!-- Display Products -->
        <div class="grid lg:grid-cols-4 md:grid-cols-2 sm:grid-cols-1 gap-8 max-w-6xl mx-auto">
            @foreach ($products as $product)
                <div class="product-card p-4 text-center border border-gray-800 mx-auto w-full">
                    <!-- Product Image -->
                    <img src="{{ asset($product->products_photo) }}" alt="{{ $product->productName }}"
                        class="object-cover w-32 h-32 mx-auto rounded-lg mb-4 border-2 border-orange-500 shadow-md hover:scale-110 transition duration-300">

                    <!-- Product Information -->
                    <div class="text-left space-y-2">
                        <div class="text-xl font-semibold text-orange-400">{{ $product->productName }}</div>
                        <div class="text-lg text-white">Price: ${{ number_format($product->price, 2) }}</div>
                        <div class="text-sm text-gray-500">In Stock: {{ $product->stockQuantity }}</div>
                    </div>

                    <!-- Reviews Section -->
                    <div class="text-left text-gray-400 space-y-2">
                        <div class="flex items-center">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-4 h-4 {{ $i <= floor($product->averageRating()) ? 'text-orange-400' : 'text-gray-300' }} transition duration-200"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.794 1.512 8.3L12 18.896 5.552 23.4l1.512-8.3L.999 9.306l8.333-1.151z" />
                                </svg>
                            @endfor
                            <span
                                class="text-sm text-gray-500 ml-2">{{ number_format($product->averageRating(), 1) }}/5</span>
                        </div>
                        <a href="{{ route('humanShop.review', ['productId' => $product->productId]) }}"
                            class="relative inline-flex items-center gap-2 px-4 py-2 bg-gray-800 text-orange-400 rounded-lg overflow-hidden group border border-orange-400/20">
                            <span
                                class="absolute inset-0 bg-gradient-to-r from-orange-400 to-orange-600 opacity-0 group-hover:opacity-20 transition-opacity duration-300"></span>
                            <span class="relative font-semibold">Reviews</span>
                            <span
                                class="relative bg-orange-500 text-gray-900 px-2 py-1 rounded-full text-xs font-bold">{{ $product->reviews->count() }}</span>
                        </a>
                    </div>

                    <!-- Add to Cart Section -->
                    <div class="flex justify-center mt-4">
                        <div class="flex items-center gap-4">
                            <label for="product-input-box-{{ $product->productId }}"
                                class="text-gray-400 text-sm">Quantity:</label>
                            <input type="number" id="product-input-box-{{ $product->productId }}"
                                class="input-field rounded-lg px-4 py-2 w-20 outline-none focus:ring-2 focus:ring-orange-500"
                                min="1" max="{{ $product->stockQuantity }}" placeholder="Qty"
                                onchange="checkStock({{ $product->productId }}, {{ $product->stockQuantity }})">
                            <span id="stock-warning-{{ $product->productId }}" class="text-red-600 text-sm hidden">Not
                                enough!</span>
                            <a href="#" onclick="addToCart({{ $product->productId }})"
                                class="btn-orange flex items-center justify-center rounded-full w-12 h-12">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" class="w-6 h-6 text-white">
                                    <path fill="currentColor"
                                        d="M29.46 10.14A2.94 2.94 0 0 0 27.1 9H10.22L8.76 6.35A2.67 2.67 0 0 0 6.41 5H3a1 1 0 0 0 0 2h3.41a.68.68 0 0 1 .6.31l1.65 3 .86 9.32a3.84 3.84 0 0 0 4 3.38h10.37a3.92 3.92 0 0 0 3.85-2.78l2.17-7.82a2.58 2.58 0 0 0-.45-2.27z" />
                                    <circle cx="14" cy="26" r="2" />
                                    <circle cx="24" cy="26" r="2" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script>
        function checkStock(productId, maxStock) {
            const inputBox = document.getElementById(`product-input-box-${productId}`);
            const warningText = document.getElementById(`stock-warning-${productId}`);

            if (inputBox.value > maxStock) {
                inputBox.value = maxStock;
                warningText.classList.remove('hidden');
            } else {
                warningText.classList.add('hidden');
            }
        }

        function addToCart(productId) {
            const quantity = document.getElementById(`product-input-box-${productId}`).value;

            if (!quantity || quantity < 1) {
                alert('Please enter a valid quantity');
                return;
            }

            window.location.href = `/addtocart/${productId}/${quantity}`;
        }
    </script>
</x-app-layout>