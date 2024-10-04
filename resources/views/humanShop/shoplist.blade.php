<head>
    <title>Human_shop</title>
    <link rel="icon" href="{{ asset('img/group21.jpg') }}" type="image/jpeg">
</head>

<x-app-layout>
    <div>
        <div class="grid lg:grid-cols-3 gap-6 mt-4 px-6 p-4">
            <!-- Display all products -->
            @foreach ($products as $product)
                        <div class="w-full bg-gray-800 rounded-lg p-4 text-center" style="border:1px solid white;">
                            <img style="width: 10rem; height: 10rem;" class="object-cover mx-auto rounded"
                                src="{{ asset($product->products_photo) }}" alt="{{ $product->productName }}">
                            <div class="mt-2 text-lg font-bold text-white">{{ $product->productName }}</div>
                            <div class="text-md text-white">${{ number_format($product->price, 2) }}</div>
                            <p class="text-white text-sm">Stock: {{ $product->stockQuantity }}</p>
                            <!-- Average Rating -->
                            <p class="text-gray-400 text-sm">Average Rating: {{ number_format($product->averageRating(), 1) }}/5</p>
                            <!-- Reviews Section -->
                            <h3>Reviews</h3>
                            @foreach ($product->reviews as $review)
                                <div class="review">
                                    <strong>{{ $review->user ? $review->user->userName : 'Anonymous' }}</strong>
                                    <!-- Use 'userName' here -->
                                    <span>Rating: {{ $review->rating }}/5</span>
                                    <p>{{ $review->comment }}</p>
                                </div>
                            @endforeach
                            <!-- Review Form -->
                            @auth
                                            @php
                                                $orderCount = Auth::user()->order()->whereHas('products', function ($query) use ($product) {
                                                    $query->where('products.productId', $product->productId);
                                                })->count();
                                                $reviewCount = Auth::user()->review()->where('productId', $product->productId)->count();
                                            @endphp

                                            @if ($orderCount > 0 && $reviewCount < $orderCount)
                                                <form action="{{ route('products.review.store', $product->productId) }}" method="POST">
                                                    @csrf
                                                    <div>
                                                        <label for="rating_{{ $product->productId }}">Rating:</label>
                                                        <select name="rating_{{ $product->productId }}" id="rating_{{ $product->productId }}" required>
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                <option value="{{ $i }}">{{ $i }}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <label for="comment_{{ $product->productId }}">Comment:</label>
                                                        <textarea name="comment_{{ $product->productId }}" id="comment_{{ $product->productId }}"
                                                            rows="3"></textarea>
                                                    </div>
                                                    <button type="submit">Submit Review</button>
                                                </form>
                                            @else
                                                <p>You can only review products you have purchased and not yet reviewed.</p>
                                            @endif
                            @else
                                <p>Please <a href="{{ route('login') }}">log in</a> to leave a review.</p>
                            @endauth




                            <!-- Add to Cart Section -->
                            <div class="flex justify-center">
                                <div class="flex justify-between items-center mt-4 rounded-lg gap-4"
                                    style="border:1px solid white; padding: 10px; width: 25rem;">
                                    <label for="product-input-box-{{ $product->productId }}"
                                        class="text-white mr-2">Quantity:</label>
                                    <input type="number" id="product-input-box-{{ $product->productId }}"
                                        class="styled-input  px-4 w-full" placeholder="จำนวน" min="1"
                                        max="{{ $product->stockQuantity }}"
                                        onchange="checkStock({{ $product->productId }}, {{ $product->stockQuantity }})">
                                    <span id="stock-warning-{{ $product->productId }}"
                                        style="display: none; color: red;">สินค้ามีไม่เพียงพอ</span>

                                    <div class="px-4">
                                        <a href="#" onclick="addToCart({{ $product->productId }})">
                                            <img src="{{ asset('img/cart.jpg') }}" style="object-fit: contain; width: 5rem;"
                                                alt="Add to Cart" />
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>

            @endforeach

        </div>
    </div>

    <script>
        function checkStock(productId, stockQuantity) {
            var inputBox = document.getElementById('product-input-box-' + productId).value;
            if (inputBox > stockQuantity || inputBox <= 0) {
                document.getElementById('stock-warning-' + productId).style.display = 'inline';
            } else {
                document.getElementById('stock-warning-' + productId).style.display = 'none';
            }
        }

        function addToCart(productId) {
            var quantity = document.getElementById('product-input-box-' + productId).value;

            if (quantity > 0) {
                window.location.href = `/addtocart/${productId}/${quantity}`;
            } else {
                alert('Please enter a valid quantity');
            }
        }
    </script>
    <footer class=" text-center text-sm text-black dark:text-white/70 items-end  justify-end p-6">
        Human_shop Project Database • 2567 :: group21
    </footer>
</x-app-layout>