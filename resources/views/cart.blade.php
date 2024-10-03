<head>
    <title>Human_shop</title>
    <link rel="icon" href="{{ asset('img/group21.jpg') }}" type="image/jpeg">
</head>

<x-app-layout>
    <div style="display: flex; flex-direction: row; justify-content: center; align-items: start;" class="w-auto">
        <div class="grid lg:grid-cols-3 gap-6 mt-4 px-6 p-4" style="display: flex; flex-direction: column;">
            <div style="display: flex; justify-content: center;">
                <div class="text-white text-center text-lg rounded-lg" style="border: 1px solid white; width: 20rem;">
                    รายการสินค้าในตะกร้า
                </div>
            </div>

            <!-- Initialize totalPrice -->
            @php $totalPrice = 0; @endphp

            <!-- Display products in the user's cart -->
            @foreach ($products as $product)
                        @php
                            // Add to total price
                            $totalPrice += $product->price * $product->pivot->quantity;
                        @endphp
                        <div class="w-auto h-32 bg-gray-800 rounded-lg p-4 text-center" style="border:1px solid white;">
                            <img style="width: 10rem; height: 10rem;" class="object-cover mx-auto rounded"
                                src="{{ asset($product->products_photo) }}" alt="{{ $product->productName }}">
                            <div class="mt-2 text-lg font-bold text-white">{{ $product->productName }}</div>
                            <div class="text-md text-white">${{ number_format($product->price, 2) }}</div>
                            <!-- Use the pivot table quantity -->
                            <div class="flex justify-center">
                                <div class="flex justify-end items-center mt-4 rounded-lg gap-4 justify-center"
                                    style="border:1px solid white; padding: 10px; width: 25rem;">
                                    <label for="product-input-box-{{ $product->productId }}"
                                        class="text-white mr-2">Quantity:</label>
                                    <input type="number" id="product-input-box-{{ $product->productId }}" class="styled-input mr-2"
                                        value="{{ $product->pivot->quantity }}" min="1" max="{{ $product->stockQuantity }}"
                                        onchange="checkStock({{ $product->productId }}, {{ $product->stockQuantity }})">

                                    <!-- Decrease Quantity Button -->
                                    <button onclick="decreaseQuantity({{ $product->productId }})"
                                        class="bg-red-500 text-black py-1 rounded px-6"
                                        style="border: 1px solid black; background-color: chartreuse;">-</button>

                                    <!-- Remove Product Button -->
                                    <button onclick="removeFromCart({{ $product->productId }})"
                                        style="border: 1px solid white; background-color: red;"
                                        class="bg-red-700 text-white px-2 py-1 rounded">Remove</button>
                                </div>
                            </div>
                        </div>
            @endforeach
        </div>

        <div>
            <div class="bg-gray-800 rounded px-6 py-6" style="margin-top: 2rem; border: 1px solid white;">
                <div class="text-lg p-2 rounded"
                    style="display: flex; justify-content: center; border: 3px solid black; background-color: aliceblue;">
                    ข้อมูลการส่งสินค้า
                </div>
                <div style="border: 1px solid white; margin-top: 2rem; width: 40rem; height: auto;"
                    class="text-white p-4 px-6 rounded-lg">
                    <div style="border: 1px solid white; width: 10rem;" class="text-center"> ข้อมูลลูกค้า</div>
                    <div class="flex flex-col mt-2">
                        <div>ชื่อ: {{ $user->userName }}</div>
                        <div>ที่อยู่: {{ $user->address ?? 'ยังไม่มีข้อมูลที่อยู่' }}</div>
                        <div>เบอร์: {{ $user->phone ?? 'ยังไม่มีข้อมูลเบอร์โทร' }}</div>
                        <div>อีเมล: {{ $user->email }}</div>
                    </div>
                </div>

                <div style="border: 1px solid white; margin-top: 2rem; width: 40rem; height: auto;"
                    class="text-white p-4 px-6 rounded-lg">
                    <div style="border: 1px solid white; width: 10rem;" class="text-center">วิธีการส่ง</div>
                    <li></li>
                    <li></li>
                    <li></li>
                </div>

                <!-- Display total price -->
                <div class="text-white text-2xl p-2 mb-4">ราคาสินค้าทั้งหมด : <span
                        class="text-white text-2xl">${{ number_format($totalPrice, 2) }}</span></div>



                <div style="display: flex; justify-content: end;">
                    <button
                        style="border: 1px solid black; margin-top: 2rem; display: flex; justify-content: center; width: 10rem; background-color: yellow;"
                        class="p-4 rounded-lg">
                        <div class="text-black">Check Out</div>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function decreaseQuantity(productId) {
            var inputBox = document.getElementById('product-input-box-' + productId);
            var quantity = parseInt(inputBox.value);

            if (quantity > 1) {
                inputBox.value = quantity - 1;

                // Send request to server to decrease the quantity and return the item to stock
                window.location.href = `/decreasefromcart/${productId}/1`;
            } else {
                alert('กรุณากดปุ่ม"Remove"เพื่อนำสินค้าออกจากตระกร้า ');
            }
        }

        function removeFromCart(productId) {
            // Redirect to the remove from cart route with productId
            window.location.href = `/removefromcart/${productId}`;
        }
    </script>
</x-app-layout>