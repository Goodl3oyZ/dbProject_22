<x-app-layout>
    @section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-6">Shopping Cart</h1>

        @if (session('status'))
            <div class="bg-green-500 text-white p-4 mb-4 rounded">
                {{ session('status') }}
            </div>
        @endif


        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Product</th>
                    <th class="py-2 px-4 border-b">Quantity</th>
                    <th class="py-2 px-4 border-b">Price</th>
                    <th class="py-2 px-4 border-b">Total</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            </thead>



    </div>
    @endsection
</x-app-layout>