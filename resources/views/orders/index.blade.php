<x-app-layout>
    <div class="flex justify-center bg-gray-900 min-h-screen">
        <div class="container mx-auto p-8 rounded-lg shadow-xl bg-gray-800 mt-5"
            style="margin-left: 10rem; margin-right: 10rem;">
            <h1 class="text-3xl font-bold mb-6 text-yellow-400 text-center">ประวัติคำสั่งซื้อของคุณ</h1>

            @if($orders->isEmpty())
                <div class="flex flex-col items-center justify-center text-gray-300 text-center mt-10">
                    <svg class="w-16 h-16 mb-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h18M9 3v1M15 3v1M3 7h18M5 7v13a2 2 0 002 2h10a2 2 0 002-2V7H5z"></path>
                    </svg>
                    <p class="text-xl font-semibold mb-2">คุณยังไม่มีคำสั่งซื้อใด ๆ</p>
                    <p class="text-gray-400">เริ่มต้นการสั่งซื้อได้เลยวันนี้ และติดตามคำสั่งซื้อของคุณได้ที่นี่</p>
                    <button onclick="window.location='{{ route('humanShop.shoplist') }}';"
                        class="mt-6 px-4 py-2 bg-blue-600 hover:bg-blue-500 text-white rounded-lg font-semibold transition duration-300 shadow-md">
                        เริ่มช้อปเลย
                    </button>
                </div>
            @else
                <table class="min-w-full bg-gray-800 border border-gray-700 rounded-lg overflow-hidden shadow-lg">
                    <thead class="bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-300 uppercase tracking-wider">
                                Order ID</th>
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
                                <td class="px-6 py-4 border-b border-gray-700">{{ $order->orderId }}</td>
                                <td class="px-6 py-4 border-b border-gray-700">{{ $order->orderDate->format('Y-m-d H:i:s') }}
                                </td>
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