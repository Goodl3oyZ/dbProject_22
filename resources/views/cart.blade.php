<head>
    <title>Human_shop</title>
    <link rel="icon" href="{{ asset('img/group21.jpg') }}" type="image/jpeg">
</head>
<x-app-layout>
    <div class="grid  lg:grid-cols-3 gap-6 mt-4 px-6 p-4">
        @foreach ($carts as $cart)
            <div class=" w-auto h-32 bg-gray-800 rounded-lg p-4 text-center">
                <img class="object-cover w-40 h-40 mx-auto rounded" src="{{ asset($product->products_photo) }}"
                    alt="{{ $product->productName }}">
            </div>

        @endforeach
    </div>
</x-app-layout>