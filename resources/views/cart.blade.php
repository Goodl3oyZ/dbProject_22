<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Human Shop</title>
    <link rel="icon" href="{{ asset('img/Logo.jpg') }}" type="image/jpeg">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<x-app-layout>
    <div class="flex flex-col lg:flex-row justify-center items-start w-full gap-6 p-6">
        <!-- Product List Section -->
        <div class="w-full lg:w-1/2 bg-gray-800 rounded-xl p-6 border border-gray-700 shadow-md">
            <div class="text-center text-xl font-bold text-orange-500 mb-4">Cart Items</div>
            @if($products->isEmpty())
                <div class="flex flex-col items-center text-center p-6 bg-gray-700 rounded-lg shadow-md">
                    <div class="text-5xl text-gray-400 mb-4 animate-bounce">
                        🎃
                    </div>
                    <div class="text-orange-500 text-xl font-semibold mb-2">Your cart is empty</div>
                    <p class="text-gray-300 mb-4">Looks like you haven't added anything to your cart yet!</p>
                    <a href="{{ route('humanShop.shoplist') }}"
                        class="inline-block px-5 py-3 bg-gradient-to-r from-orange-600 to-orange-500 text-white rounded-full font-medium shadow-lg hover:from-orange-500 hover:to-orange-400 transition-transform transform hover:scale-105">
                        Browse Products
                    </a>
                </div>
            @endif

            @php
                $totalPrice = 0;
                $discountPercentage = $promotion ? $promotion->discountPercentage : 0;
            @endphp
            @foreach ($products as $product)
                        @php
                            $totalPrice += $product->price * $product->pivot->quantity;
                        @endphp
                        <div class="w-full bg-gray-700 rounded-lg p-5 mb-5 shadow-sm transition-shadow hover:shadow-lg">
                            <div class="flex flex-col md:flex-row items-center gap-4">
                                <img class="w-24 h-24 object-cover rounded shadow-sm" src="{{ asset($product->products_photo) }}"
                                    alt="{{ $product->productName }}">
                                <div class="text-center md:text-left flex-1">
                                    <div class="text-lg font-semibold text-orange-500">{{ $product->productName }}</div>
                                    <div class="text-md text-gray-300">${{ number_format($product->price, 2) }}</div>
                                </div>
                                <div class="flex items-center gap-4">
                                    <label for="product-input-box-{{ $product->productId }}" class="text-gray-300">Quantity:</label>
                                    <input type="number" id="product-input-box-{{ $product->productId }}"
                                        class="w-16 p-2 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                                        value="{{ $product->pivot->quantity }}" min="1" max="{{ $product->stockQuantity }}"
                                        onchange="setQuantity({{ $product->productId }}, this.value, {{ $product->stockQuantity }})">
                                    <button onclick="removeFromCart({{ $product->productId }})"
                                        class="bg-red-600 text-white py-1 px-3 rounded-lg transition-colors hover:bg-red-500">
                                        Remove
                                    </button>
                                </div>
                            </div>
                        </div>
            @endforeach
        </div>

        <!-- Customer Information Section -->
        <div
            class="w-full lg:w-1/3 bg-gradient-to-br from-gray-900 to-gray-800 rounded-xl p-5 border border-orange-500 shadow-xl transform transition-transform hover:scale-105 mt-1">
            <form action="{{ route('checkout') }}" method="POST" class="flex flex-col gap-5">
                @csrf
                <!-- Header Section with Icon -->
                <div class="flex flex-col items-center pb-2">
                    <div class="text-3xl text-orange-500 mb-1 animate-bounce">
                        🧛
                    </div>
                    <div class="text-lg font-bold text-orange-500">Shipping Information</div>
                </div>

                <!-- Customer Information Section -->
                <div
                    class="bg-gradient-to-r from-gray-800 to-gray-700 p-5 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                    <div class="text-center text-md font-semibold text-orange-500 mb-3">Customer Information</div>
                    @if(session('customerInfo'))
                        <div class="text-orange-400 mb-3 space-y-1 text-sm">
                            <p><strong>Name:</strong> {{ session('customerInfo.customerName') }}</p>
                            <p><strong>Address:</strong> {{ session('customerInfo.customerAddress') }}</p>
                            <p><strong>Phone:</strong> {{ session('customerInfo.customerPhone') }}</p>
                            <p><strong>Email:</strong> {{ session('customerInfo.customerEmail') }}</p>
                        </div>
                    @else
                        <div class="flex flex-col gap-3">
                            @foreach(['customerName' => 'Name', 'customerAddress' => 'Address', 'customerPhone' => 'Phone', 'customerEmail' => 'Email'] as $field => $label)
                                <div>
                                    <label for="{{ $field }}" class="text-orange-400 font-medium text-sm">{{ $label }}:</label>
                                    <input type="{{ $field == 'customerEmail' ? 'email' : 'text' }}" id="{{ $field }}"
                                        name="{{ $field }}"
                                        class="w-full p-2 rounded-lg bg-gray-700 text-orange-200 text-sm focus:outline-none focus:ring-2 focus:ring-orange-500 transition duration-200 transform hover:bg-gray-600"
                                        placeholder="Enter your {{ strtolower($label) }}" value="{{ old($field) }}">
                                    @error($field)
                                        <div class="text-red-400 text-xs">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Payment Method Selection -->
                <div>
                    <label for="shippingMethod" class="text-orange-400 font-medium text-sm">Choose Payment
                        Method:</label>
                    <select id="shippingMethod" name="shippingMethod"
                        class="w-full p-2 rounded-lg bg-gray-700 text-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-orange-500 mt-1 transition duration-200 transform hover:bg-gray-600">
                        <option value="cash">Cash</option>
                        <option value="credit_card">Credit/Debit Card</option>
                        <option value="bank_transfer">Bank Transfer</option>
                        <option value="promptpay">PromptPay</option>
                    </select>
                </div>

                <!-- Price Summary -->
                @php
                    $discountAmount = ($totalPrice * $discountPercentage) / 100;
                    $totalPriceAfterDiscount = $totalPrice - $discountAmount;
                @endphp
                <div class="text-orange-400 text-sm font-semibold mt-3">Total Price:
                    ${{ number_format($totalPrice, 2) }}</div>
                @if ($promotion)
                    <div class="text-orange-400 text-sm font-semibold">Discount: {{ $discountPercentage }}%</div>
                    <div class="text-orange-500 text-md font-bold">Net Price:
                        ${{ number_format($totalPriceAfterDiscount, 2) }}</div>
                @endif
                <input type="hidden" name="totalAmount" value="{{ $totalPriceAfterDiscount }}">

                <!-- Checkout Button with Conditional Styling -->
                <button type="submit"
                    class="w-full bg-gradient-to-r from-orange-600 to-orange-500 text-black py-2 rounded-lg font-bold mt-3 shadow-md transition-transform transform hover:scale-105 hover:shadow-lg hover:from-orange-500 hover:to-orange-400 text-sm {{ $products->isEmpty() || $totalPriceAfterDiscount <= 0 ? 'opacity-50 cursor-not-allowed' : '' }}"
                    {{ $products->isEmpty() || $totalPriceAfterDiscount <= 0 ? 'disabled' : '' }}>
                    Check Out
                </button>
            </form>
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