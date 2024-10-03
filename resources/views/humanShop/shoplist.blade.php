<head>
    <title>Human_shop</title>
    <link rel="icon" href="{{ asset('img/group21.jpg') }}" type="image/jpeg">
</head>

<x-app-layout>
    <div>
        <div class="grid lg:grid-cols-3 gap-6 mt-4 px-6 p-4">
            <!-- Display all products -->
            @foreach ($products as $product)
                <div class="w-auto h-32 bg-gray-800 rounded-lg p-4 text-center" style="border:1px solid white;">
                    <img style="width: 10rem; height: 10rem;" class="object-cover mx-auto rounded"
                        src="{{ asset($product->products_photo) }}" alt="{{ $product->productName }}">
                    <div class="mt-2 text-lg font-bold text-white">{{ $product->productName }}</div>
                    <div class="text-md text-white">${{ number_format($product->price, 2) }}</div>
                    <p class="text-white text-sm">Stock: {{ $product->stockQuantity }}</p>

                    <div class="flex justify-center">
                        <div class="flex justify-between items-center mt-4 rounded-lg"
                            style="border:1px solid white; padding: 10px; width: 25rem;">
                            <label for="product-input-box-{{ $product->productId }}"
                                class="text-white mr-2">Quantity:</label>
                            <input type="number" id="product-input-box-{{ $product->productId }}"
                                class="styled-input mr-2 px-4 w-full" placeholder="จำนวน" min="1"
                                max="{{ $product->stockQuantity }}"
                                onchange="checkStock({{ $product->productId }}, {{ $product->stockQuantity }})">


                            <span id="stock-warning-{{ $product->productId }}"
                                style="display: none; color: red;">สินค้ามีไม่เพียงพอ</span>

                            <a href="#" onclick="addToCart({{ $product->productId }})">
                                <img src="{{ asset('img/cart.jpg') }}" class="w-auto h-6" alt="Add to Cart" />
                            </a>
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