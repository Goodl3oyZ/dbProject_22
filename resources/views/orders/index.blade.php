<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Human Shop</title>
    <link rel="icon" href="{{ asset('img/Logo.jpg') }}" type="image/jpeg">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* Animated Gradient Background */
        .animated-bg {
            background: linear-gradient(120deg, #1f2937, #111827, #374151, #111827);
            background-size: 200% 200%;
            animation: gradientMove 15s ease infinite;
        }

        /* Animation Keyframes */
        @keyframes gradientMove {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
    </style>
</head>

<x-app-layout>
    <div class="flex justify-center min-h-screen animated-bg">
        <div class="container mx-auto p-8 rounded-lg shadow-xl bg-gray-800 bg-opacity-90 mt-5"
            style="margin-left: 10rem; margin-right: 10rem;">
            <h1 class="text-3xl font-bold mb-6 text-orange-500 text-center">A Record of Your Purchases</h1>

            @if($orders->isEmpty())
                <div class="flex flex-col items-center justify-center text-gray-300 text-center mt-10">
                    <svg class="w-16 h-16 mb-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h18M9 3v1M15 3v1M3 7h18M5 7v13a2 2 0 002 2h10a2 2 0 002-2V7H5z"></path>
                    </svg>
                    <p class="text-xl font-semibold mb-2">You have no orders yet</p>
                    <p class="text-gray-400">Start shopping today and track your orders here</p>
                    <button onclick="window.location='{{ route('humanShop.shoplist') }}';"
                        class="mt-6 px-4 py-2 bg-blue-600 hover:bg-blue-500 text-white rounded-lg font-semibold transition duration-300 shadow-md">
                        Start Shopping
                    </button>
                </div>
            @else
                <table class="min-w-full bg-gray-800 border border-gray-700 rounded-lg overflow-hidden shadow-lg">
                    <thead class="bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-300 uppercase tracking-wider">
                                Order No</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-300 uppercase tracking-wider">
                                Order Date</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-300 uppercase tracking-wider">
                                Total Amount</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-300 uppercase tracking-wider">
                                Shipping Method</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-800 text-gray-200">
                        @foreach($orders as $order)
                            <tr class="hover:bg-gray-700 transition duration-300 ease-in-out">
                                <td class="px-6 py-4 border-b border-gray-700">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 border-b border-gray-700">{{ $order->orderDate->format('Y-m-d H:i:s') }}</td>
                                <td class="px-6 py-4 border-b border-gray-700">${{ number_format($order->totalAmount, 2) }}</td>
                                <td class="px-6 py-4 border-b border-gray-700">{{ ucfirst($order->shipping) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</x-app-layout>
