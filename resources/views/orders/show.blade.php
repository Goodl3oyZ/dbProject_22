<!-- resources/views/orders/show.blade.php -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Human Shop</title>
    <link rel="icon" href="{{ asset('img/Logo.jpg') }}" type="image/jpeg">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Custom styles for animated gradient background -->
    <style>
        /* Smooth, rich gradient background animation */
        .animated-bg {
            background: linear-gradient(135deg, #1a202c, #2d3748, #1a202c);
            background-size: 200% 200%;
            animation: gradientShift 20s ease infinite;
        }

        @keyframes gradientShift {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        /* Enhanced shadow for main container */
        .shadow-elevated {
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.5);
        }

        /* Glow effect on hover for button */
        .glow-on-hover:hover {
            box-shadow: 0px 4px 20px rgba(59, 130, 246, 0.6);
            /* Blue glow */
        }
    </style>
</head>

<x-app-layout>
    <div class="flex justify-center items-center min-h-screen animated-bg">
        <div
            class="container mx-auto p-8 bg-gray-800 bg-opacity-90 rounded-lg shadow-elevated max-w-3xl text-white border border-yellow-500">
            <h1 class="text-3xl font-bold mb-6 text-orange-500 text-center">Order Details</h1>

            <div
                class="p-6 bg-gray-900 rounded-lg shadow-md transition duration-300 ease-in-out transform hover:scale-105 hover:shadow-2xl">
                <h2 class="text-2xl mb-4 font-semibold text-orange-400">Order In Process</h2>
                <p class="text-lg"><strong>Recipient Name:</strong> {{ $order->customerName }}</p>
                <p class="text-lg"><strong>Shipping Address:</strong> {{ $order->shippingAddress }}</p>
                <p class="text-lg"><strong>Phone Number:</strong> {{ $order->customerPhone }}</p>
                <p class="text-lg"><strong>Email:</strong> {{ $order->customerEmail }}</p>
                <p class="text-lg"><strong>Order Date:</strong> {{ $order->orderDate }}</p>
                <p class="text-lg"><strong>Payment Method:</strong> {{ ucfirst($order->shippingMethod) }}</p>
                <p class="text-lg"><strong>Total Amount:</strong> ${{ number_format($order->totalAmount, 2) }}</p>

                <h3 class="text-xl font-semibold mt-6 mb-4 text-orange-400">Product List:</h3>

                @if ($order->products->isNotEmpty())
                    <ul class="space-y-3">
                        @foreach ($order->products as $product)
                            <li
                                class="bg-gray-700 p-4 rounded-lg shadow-lg flex justify-between items-center transition transform hover:scale-105 hover:shadow-lg">
                                <span class="text-orange-400 font-semibold">{{ $product->productName }}</span>
                                <span class="text-gray-300">Quantity: {{ $product->pivot->quantity }}</span>
                                <span class="text-gray-400">Price: ${{ number_format($product->price, 2) }}</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-400 mt-4">No products found for this order.</p>
                @endif
            </div>

            <!-- Return Button with Glow Effect -->
            <div class="flex justify-center"> <!-- เพิ่ม div wrapper นี้ -->
                <button type="button" onclick="window.location='{{ route('dashboard') }}';"
                    class="glow-on-hover mt-8 text-white px-6 py-2 rounded-lg bg-blue-600 transition-colors duration-300 ease-in-out hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-400 flex items-center justify-center shadow-md"
                    style="width: 10rem;">
                    Return to Dashboard
                </button>
            </div>
        </div>
    </div>
</x-app-layout>