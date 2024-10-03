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
            @php                      
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                $totalPrice = 0;
                $totalPrice = 0;
                $discountPercentage = $promotion ? $promotion->discountPercentage : 0;
            @endphp
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
            <form action="{{ route('checkout') }}" method="POST" class="flex flex-col">
                @csrf <!-- CSRF protection -->
                <div class="bg-gray-800 rounded px-6 py-6" style="margin-top: 2rem; border: 1px solid white;">
                    <div class="text-lg p-2 rounded-lg"
                        style="display: flex; justify-content: center; border: 3px solid black; background-color: aliceblue;">
                        ข้อมูลการส่งสินค้า
                    </div>
                    <!-- Include customer info fields here (name, address, phone, email) -->
                    <div style="border: 1px solid white; margin-top: 2rem; width: 25rem; height: auto;"
                        class="text-white p-4 px-6 rounded-lg text-lg">
                        <div style="border: 1px solid white; width: 10rem;" class="text-center rounded-lg">ข้อมูลลูกค้า
                        </div>

                        <!-- Display saved customer info if available -->
                        @if(session('customerInfo'))
                            <div class="mb-2 mt-4">
                                <p>ชื่อ: {{ session('customerInfo.customerName') }}</p>
                                <p>ที่อยู่: {{ session('customerInfo.customerAddress') }}</p>
                                <p>เบอร์: {{ session('customerInfo.customerPhone') }}</p>
                                <p>อีเมล: {{ session('customerInfo.customerEmail') }}</p>
                            </div>
                        @else
                            <!-- Show the form to input customer data only if it's not saved yet -->
                            <div class="mt-4 mb-4">
                                <!-- ชื่อ -->
                                <div>
                                    <div><label for="customerName" class="text-white">ชื่อ:</label></div>
                                    <div class=" px-6"><input type="text" id="customerName" name="customerName"
                                            class=" p-2 rounded bg-gray-700 text-black focus:outline-none focus:ring-2 focus:ring-blue-500"
                                            placeholder="กรอกชื่อของคุณ" value="{{ old('customerName') }}">
                                        @error('customerName')
                                            <div style="color: red; font-size: small;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- ที่อยู่ -->
                                <div>
                                    <div><label for="customerAddress" class="mt-2 text-white">ที่อยู่:</label></div>
                                    <div class=" px-6"><input type="text" id="customerAddress" name="customerAddress"
                                            class="p-2 rounded bg-gray-700 text-black focus:outline-none focus:ring-2 focus:ring-blue-500"
                                            placeholder="กรอกที่อยู่ของคุณ" value="{{ old('customerAddress') }}">
                                        @error('customerAddress')
                                            <div style="color: red; font-size: small;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- เบอร์ -->
                                <div>
                                    <div><label for="customerPhone" class="mt-2 text-white">เบอร์:</label></div>
                                    <div class=" px-6"><input type="text" id="customerPhone" name="customerPhone"
                                            class="p-2 rounded bg-gray-700 text-black focus:outline-none focus:ring-2 focus:ring-blue-500"
                                            placeholder="กรอกเบอร์โทรของคุณ" value="{{ old('customerPhone') }}">
                                        @error('customerPhone')
                                            <div style="color: red; font-size: small;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <!-- อีเมล -->
                                <div>
                                    <div><label for="customerEmail" class="mt-2 text-white">อีเมล:</label></div>
                                    <div class=" px-6"><input type="email" id="customerEmail" name="customerEmail"
                                            class="p-2 rounded bg-gray-700 text-black focus:outline-none focus:ring-2 focus:ring-blue-500"
                                            placeholder="กรอกอีเมลของคุณ" value="{{ old('customerEmail') }}">
                                        @error('customerEmail')
                                            <div style="color: red; font-size: small;">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <!-- Shipping Method -->
                    <div class="mt-4"><label for="shippingMethod"
                            class="text-white text-lg ">เลือกวิธีการชำระเงิน:</label>
                        <select type="hidden" id="shippingMethod" name="shippingMethod"
                            class="rounded bg-gray-700 text-black px-8 mt-2 "
                            style=" display: flex; justify-content: start;">
                            <option value="online">Online</option>
                            <option value="delivery">Delivery</option>
                        </select>
                    </div>
                    <!-- Display total price and other cart details here -->
                    <div class="mt-2 mb-4 rounded-lg">
                        <div class="text-white text-lg">ราคาสินค้าทั้งหมด: $ {{ number_format($totalPrice, 2) }}</div>

                        <!-- Apply the discount if there's a promotion -->
                        @php
                            $discountAmount = ($totalPrice * $discountPercentage) / 100;
                            $totalPriceAfterDiscount = $totalPrice - $discountAmount;
                        @endphp

                        @if ($promotion)
                            <div class="text-white text-lg mt-2">ส่วนลดที่คุณมี: {{ $discountPercentage }}%</div>
                            <div class="text-white text-lg mt-2">ราคาสุทธิ:
                                ${{ number_format($totalPriceAfterDiscount, 2) }}
                            </div>
                        @endif
                    </div>
                    <!-- Pass the net total amount to the checkout method -->
                    <input type="hidden" name="totalAmount" value="{{ $totalPriceAfterDiscount }}">
                    <!-- Submit Button -->
                    <div style="display: flex; justify-content: end;">
                        <button type="submit"
                            style="border: 1px solid black; margin-top: 2rem; display: flex; justify-content: center; width: 10rem; background-color: {{ $products->isEmpty() || $totalPriceAfterDiscount <= 0 ? 'gray' : 'yellow' }};"
                            class="p-4 rounded-lg text-black" @if($products->isEmpty() || $totalPriceAfterDiscount <= 0)
                            disabled @endif>
                            Check Out
                        </button>

                    </div>
            </form>
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
        document.addEventListener('DOMContentLoaded', function () {
            var totalAmount = {{ $totalPriceAfterDiscount }};
            var checkoutButton = document.getElementById('checkout-button');

            // Disable the checkout button if total amount is 0
            if (totalAmount <= 0) {
                checkoutButton.disabled = true;
            }
        });
    </script>
    <footer class=" text-center text-sm text-black dark:text-white/70 items-end  justify-end p-6">
        Human_shop Project Database • 2567 :: group21
    </footer>
</x-app-layout>