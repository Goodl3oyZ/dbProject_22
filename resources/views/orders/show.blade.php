<!-- resources/views/orders/show.blade.php -->

<head>
    <title>Order Details</title>
</head>

<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6 text-yellow-400 text-center">รายละเอียดคำสั่งซื้อ</h1>

        <div class="bg-gray-800 rounded-lg p-6 text-white shadow-lg border border-yellow-400">
            <h2 class="text-2xl mb-4 font-semibold">Order In Process</h2>
            <p class="text-lg"><strong>ชื่อผู้รับ:</strong> {{ $order->customerName }}</p>
            <p class="text-lg"><strong>ที่อยู่จัดส่ง:</strong> {{ $order->shippingAddress }}</p>
            <p class="text-lg"><strong>เบอร์โทร:</strong> {{ $order->customerPhone }}</p>
            <p class="text-lg"><strong>อีเมล:</strong> {{ $order->customerEmail }}</p>
            <p class="text-lg"><strong>วันที่สั่งซื้อ:</strong> {{ $order->orderDate }}</p>
            <p class="text-lg"><strong>วิธีการจัดส่ง:</strong> {{ ucfirst($order->shipping) }}</p>
            <p class="text-lg"><strong>ยอดรวม:</strong> ${{ number_format($order->totalAmount, 2) }}</p>

            <h3 class="text-xl font-semibold mt-6 mb-4">รายการสินค้า:</h3>

            @if ($order->products->isNotEmpty())
                <ul class="space-y-3">
                    @foreach ($order->products as $product)
                        <li class="bg-gray-700 p-3 rounded-lg shadow-md">
                            <span class="text-yellow-400 font-semibold">{{ $product->productName }}</span>
                            - <span>จำนวน: {{ $product->pivot->quantity }}</span>
                            - <span>ราคา: ${{ number_format($product->price, 2) }}</span>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-400 mt-4">No products found for this order.</p>
            @endif
        </div>

        <button type="button" onclick="window.location='{{ route('dashboard') }}';"
            class="text-white px-6 py-2 mt-6 rounded-lg bg-blue-600 hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-yellow-400 transition duration-300 mx-auto flex items-center justify-center shadow-md"
            style="width: 10rem;">
            กลับไปหน้าหลัก
        </button>
    </div>
</x-app-layout>