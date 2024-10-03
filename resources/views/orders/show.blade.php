<!-- resources/views/orders/show.blade.php -->

<head>
    <title>Order Details</title>
</head>

<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4 text-white">รายละเอียดคำสั่งซื้อ</h1>

        <div class="bg-gray-800 rounded p-4 text-white " style="border: 1px solid white;">
            <h2 class="text-xl">Order #{{ $order->orderId }}</h2>
            <p>ชื่อผู้รับ: {{ $order->customerName }}</p>
            <p>ที่อยู่จัดส่ง: {{ $order->shippingAddress }}</p>
            <p>เบอร์โทร: {{ $order->customerPhone }}</p>
            <p>อีเมล: {{ $order->customerEmail }}</p>
            <p>วันที่สั่งซื้อ: {{ $order->orderDate }}</p>
            <p>วิธีการจัดส่ง: {{ $order->shipping }}</p>
            <p>ยอดรวม: ${{ number_format($order->totalAmount, 2) }}</p>

            <h3 class="text-lg mt-4">รายการสินค้า:</h3>
            <ul>
                @foreach ($order->products as $product)
                    <li>
                        {{ $product->productName }} - จำนวน: {{ $product->pivot->quantity }} - ราคา:
                        ${{ number_format($product->price, 2) }}
                    </li>
                @endforeach
            </ul>
        </div>

        <button type="button" onclick="window.location='{{ route('dashboard') }}';"
            style="border: 1px solid white; display: flex; justify-content: center; width: 10rem; background-color: blue;"
            class="text-white px-4 mt-4 p-2 rounded">
            กลับไปหน้าหลัก
        </button>

    </div>
</x-app-layout>