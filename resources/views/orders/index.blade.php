<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">ประวัติคำสั่งซื้อของคุณ</h1>

        @if($orders->isEmpty())
            <p class="text-gray-600">คุณยังไม่มีคำสั่งซื้อใด ๆ.</p>
        @else
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border-b">Order ID</th>
                        <th class="px-4 py-2 border-b">Order Date</th>
                        <th class="px-4 py-2 border-b">Total Amount</th>
                        <th class="px-4 py-2 border-b">Shipping Method</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td class="px-4 py-2 border-b">{{ $order->orderId }}</td>
                            <td class="px-4 py-2 border-b">{{ $order->orderDate->format('Y-m-d H:i:s') }}</td>
                            <td class="px-4 py-2 border-b">${{ number_format($order->totalAmount, 2) }}</td>
                            <td class="px-4 py-2 border-b">{{ ucfirst($order->shipping) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-app-layout>