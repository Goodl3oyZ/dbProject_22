<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Human_shop</title>
    <link rel="icon" href="{{ asset('img/group21.jpg') }}" type="image/jpeg">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<x-app-layout>
    <div class="flex flex-col lg:flex-row justify-center items-start w-full gap-6 p-6">
        <!-- Product List Section -->
        <div class="w-full lg:w-1/2 bg-gray-800 rounded-lg p-4 border border-gray-700">
            <div class="text-center text-lg font-bold text-white mb-4">รายการสินค้าในตะกร้า</div>
            @if($products->isEmpty())
                <div class="text-white text-center">. . . ยังไม่มีสินค้าในตะกร้า . . .</div>
            @endif
            @php
                $totalPrice = 0;
                $discountPercentage = $promotion ? $promotion->discountPercentage : 0;
            @endphp
            @foreach ($products as $product)
                        @php
                            $totalPrice += $product->price * $product->pivot->quantity;
                        @endphp
                        <div class="w-full bg-gray-700 rounded-lg p-4 mb-4">
                            <div class="flex flex-col md:flex-row items-center gap-4">
                                <img class="w-24 h-24 object-cover rounded" src="{{ asset($product->products_photo) }}"
                                    alt="{{ $product->productName }}">
                                <div class="text-center md:text-left">
                                    <div class="text-lg font-bold text-yellow-500">{{ $product->productName }}</div>
                                    <div class="text-md text-white">${{ number_format($product->price, 2) }}</div>
                                </div>
                                <div class="flex items-center gap-4">
                                    <label for="product-input-box-{{ $product->productId }}" class="text-white">Quantity:</label>
                                    <input type="number" id="product-input-box-{{ $product->productId }}"
                                        class="w-16 p-2 text-gray-900 rounded focus:outline-none focus:ring-2 focus:ring-yellow-500"
                                        value="{{ $product->pivot->quantity }}" min="1" max="{{ $product->stockQuantity }}"
                                        onchange="setQuantity({{ $product->productId }}, this.value, {{ $product->stockQuantity }})">
                                    <button onclick="removeFromCart({{ $product->productId }})"
                                        class="bg-red-600 text-white py-1 px-3 rounded">Remove</button>
                                </div>
                            </div>
                        </div>
            @endforeach
        </div>

        <!-- Customer Information Section -->
        <div class="w-full lg:w-1/4 bg-gray-800 rounded-lg p-4 border border-gray-700">
            <form action="{{ route('checkout') }}" method="POST" class="flex flex-col gap-4">
                @csrf
                <div class="text-lg text-center font-bold text-yellow-500">ข้อมูลการส่งสินค้า</div>
                <div class="bg-gray-700 p-4 rounded-lg">
                    <div class="text-center text-lg font-bold text-white mb-4">ข้อมูลลูกค้า</div>
                    @if(session('customerInfo'))
                        <div class="text-white mb-4">
                            <p>ชื่อ: {{ session('customerInfo.customerName') }}</p>
                            <p>ที่อยู่: {{ session('customerInfo.customerAddress') }}</p>
                            <p>เบอร์: {{ session('customerInfo.customerPhone') }}</p>
                            <p>อีเมล: {{ session('customerInfo.customerEmail') }}</p>
                        </div>
                    @else
                        <div class="flex flex-col gap-2">
                            <div>
                                <label for="customerName" class="text-white">ชื่อ:</label>
                                <input type="text" id="customerName" name="customerName"
                                    class="w-full p-2 rounded bg-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-yellow-500"
                                    placeholder="กรอกชื่อของคุณ" value="{{ old('customerName') }}">
                                @error('customerName')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label for="customerAddress" class="text-white">ที่อยู่:</label>
                                <input type="text" id="customerAddress" name="customerAddress"
                                    class="w-full p-2 rounded bg-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-yellow-500"
                                    placeholder="กรอกที่อยู่ของคุณ" value="{{ old('customerAddress') }}">
                                @error('customerAddress')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label for="customerPhone" class="text-white">เบอร์:</label>
                                <input type="text" id="customerPhone" name="customerPhone"
                                    class="w-full p-2 rounded bg-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-yellow-500"
                                    placeholder="กรอกเบอร์โทรของคุณ" value="{{ old('customerPhone') }}">
                                @error('customerPhone')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label for="customerEmail" class="text-white">อีเมล:</label>
                                <input type="email" id="customerEmail" name="customerEmail"
                                    class="w-full p-2 rounded bg-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-yellow-500"
                                    placeholder="กรอกอีเมลของคุณ" value="{{ old('customerEmail') }}">
                                @error('customerEmail')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    @endif
                </div>
                <div>
                    <label for="shippingMethod" class="text-white">เลือกวิธีการชำระเงิน:</label>
                    <select id="shippingMethod" name="shippingMethod"
                        class="w-full p-2 rounded bg-gray-600 text-white focus:outline-none focus:ring-2 focus:ring-yellow-500 mt-2">
                        <option value="online">Online</option>
                        <option value="delivery">Delivery</option>
                    </select>
                </div>
                @php
                    $discountAmount = ($totalPrice * $discountPercentage) / 100;
                    $totalPriceAfterDiscount = $totalPrice - $discountAmount;
                @endphp
                <div class="text-white text-lg">ราคาสินค้าทั้งหมด: ${{ number_format($totalPrice, 2) }}</div>
                @if ($promotion)
                    <div class="text-white text-lg">ส่วนลดที่คุณมี: {{ $discountPercentage }}%</div>
                    <div class="text-white text-lg">ราคาสุทธิ: ${{ number_format($totalPriceAfterDiscount, 2) }}</div>
                @endif
                <input type="hidden" name="totalAmount" value="{{ $totalPriceAfterDiscount }}">
                <button type="submit"
                    class="w-full bg-yellow-500 text-black py-3 rounded-lg font-bold mt-4 {{ $products->isEmpty() || $totalPriceAfterDiscount <= 0 ? 'opacity-50 cursor-not-allowed' : 'hover:bg-yellow-400' }}"
                    {{ $products->isEmpty() || $totalPriceAfterDiscount <= 0 ? 'disabled' : '' }}>Check Out</button>
            </form>
        </div>
    </div>

    <script>
        function setQuantity(productId, newQuantity, maxStock) {
            if (newQuantity < 1) {
                alert('Quantity cannot be less than 1');
                document.getElementById('product-input-box-' + productId).value = 1;
                return;
            }
            if (newQuantity > maxStock) {
                alert('Cannot exceed available stock');
                document.getElementById('product-input-box-' + productId).value = maxStock;
                return;
            }
            window.location.href = `/decreasefromcart/${productId}/${newQuantity}`;
        }

        function removeFromCart(productId) {
            window.location.href = `/removefromcart/${productId}`;
        }
    </script>
</x-app-layout>