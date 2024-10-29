<x-app-layout>
    <div class="container mx-auto px-6 py-8">
        <h2 class="text-2xl font-bold text-yellow-400 mb-6 text-center">{{ $product->productName }} - Reviews</h2>

        <!-- Product Image -->
        <div class="flex justify-center mb-6">
            <img src="{{ asset($product->products_photo) }}" alt="{{ $product->productName }}"
                class="object-cover w-40 h-40 rounded-lg border-2 border-yellow-500 shadow-md">
        </div>

        <!-- Product Information -->
        <div class="text-center space-y-2 mb-8">
            <div class="text-xl font-semibold text-yellow-400">{{ $product->productName }}</div>
            <div class="text-lg text-white">Price: ${{ number_format($product->price, 2) }}</div>
            <div class="text-sm text-gray-500">In Stock: {{ $product->stockQuantity }}</div>
        </div>

        <!-- Add Review Form -->
        <div class="bg-gray-800 p-6 rounded-lg shadow-lg mb-8">
            <h3 class="text-xl font-semibold text-yellow-400 mb-4 text-center">Add Your Review</h3>
            <form action="{{ route('humanShop.review.store', ['productId' => $product->productId]) }}" method="POST">
                @csrf
                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="mb-4">
                    <label class="block text-yellow-400 mb-2">Rating</label>
                    <select name="rating_{{ $product->productId }}"
                        class="bg-gray-700 text-white rounded px-4 py-2 w-full focus:ring-2 focus:ring-yellow-500">
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-yellow-400 mb-2">Comment</label>
                    <textarea name="comment_{{ $product->productId }}"
                        class="bg-gray-700 text-white rounded px-4 py-2 w-full focus:ring-2 focus:ring-yellow-500"
                        rows="3"></textarea>
                </div>
                <button type="submit"
                    class="bg-yellow-400 text-black font-semibold px-4 py-2 rounded hover:bg-yellow-500 w-full">
                    Submit Review
                </button>
            </form>
        </div>

        <!-- Display all reviews -->
        <div class="space-y-6">
            <p class="text-center text-lg font-semibold text-yellow-400">Average Rating:
                {{ number_format($product->averageRating(), 1) }}/5
            </p>
            @foreach ($product->reviews as $review)
                <div class="border-b border-gray-700 py-4 px-4">
                    <strong class="text-white">{{ $review->user ? $review->user->userName : 'Anonymous' }}</strong>
                    <span class="text-yellow-400">rated: {{ $review->rating }}/5</span>
                    <p class="text-sm text-gray-400 mt-2">{{ $review->comment }}</p>
                </div>
            @endforeach
        </div>

        <!-- Back to Product Page -->
        <div class="mt-8 text-center">
            <a href="{{ route('humanShop.shoplist') }}" class="text-yellow-400 hover:underline transition duration-300">
                Back to Products
            </a>
        </div>
    </div>
</x-app-layout>