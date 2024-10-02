<x-app-layout>
    <div>
        <div class="grid  lg:grid-cols-3 gap-6 mt-4 px-6 p-4">
            @foreach ($products as $product)
                <div class=" w-auto h-32 bg-gray-800 rounded-lg p-4 text-center">
                    <img class="object-cover w-40 h-40 mx-auto rounded" src="{{ asset($product->products_photo) }}"
                        alt="{{ $product->productName }}">
                    <div class="mt-2 text-lg font-bold text-white">{{ $product->productName }}</div>
                    <div class="text-md text-white">${{ number_format($product->price, 2) }}</div>
                    <p class="text-white text-sm">Stock: {{ $product->stockQuantity }}</p>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>