<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Human_shop</title>
    <link rel="icon" href="{{ asset('img/group21.jpg') }}" type="image/jpeg">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-sans antialiased bg-gray-900 text-gray-200">
    <div class="min-h-screen">
        <!-- Header Section -->
        <header class="bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 border-b border-gray-700 shadow-2xl">
            <div class="container mx-auto flex items-center justify-between p-6">
                <div class="flex items-center">
                    <img class="h-10 w-10 rounded-full border-2 border-yellow-500" src="{{ asset('img/group21.jpg') }}"
                        alt="Human Shop">
                    <span class="ml-4 text-2xl font-bold text-yellow-500">Human Shop</span>
                </div>
                <!-- Right: Login & Register -->
                @if (Route::has('login'))
                    <nav class="flex gap-4">
                        @auth
                            <a href="{{ url('/dashboard') }}"
                                class="px-4 py-2 border border-yellow-500 text-yellow-500 rounded-lg hover:bg-yellow-500 hover:text-gray-900 transition-all">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}"
                                class="px-4 py-2 border border-yellow-500 text-yellow-500 rounded-lg hover:bg-yellow-500 hover:text-gray-900 transition-all">Log
                                in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="px-4 py-2 border border-yellow-500 text-yellow-500 rounded-lg hover:bg-yellow-500 hover:text-gray-900 transition-all">Register</a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </div>
        </header>

        <!-- Main Content Section -->
        <main class="container mx-auto p-8">

            <!-- Product Section -->
            <section>
                <h2 class="text-4xl font-bold text-yellow-500 mb-8 text-center">Our Products</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Product Card -->
                    @foreach([['Heart', 'หัวใจมือ 2 สภาพดี,สวย พึ่งได้มาสดๆร้อนๆ', 'img/heart.jpg'], ['Kidney', 'ไตสะอาด ปราศจากของเหลวจำพวกปัสสาวะ', 'img/kidney.jpg'], ['Lung', 'ปอดหมู สีสวย ชมพูอมเขียว', 'img/lung.jpg'], ['Liver', 'ตับ ตับ ตับ ตับ ตัวพี่ชอบกินตับเด็ก', 'img/liver.jpg'], ['Bladder', 'กระเพาะปัสสาวะ เหมาะสำหรับคนที่ชอบอั้นฉี่เป็นเวลานานๆ', 'img/bladder.jpg'], ['Intestine', 'ไส้ย่าง สันป่าข่อย', 'img/intestine.jpg']] as $product)
                        <div
                            class="bg-gray-800 border border-gray-700 rounded-xl overflow-hidden shadow-lg transform transition hover:scale-105">
                            <img class="h-48 w-full object-cover" src="{{ asset($product[2]) }}" alt="{{ $product[0] }}">
                            <div class="p-6">
                                <h3 class="text-2xl font-bold text-yellow-500 mb-2">{{ $product[0] }}</h3>
                                <p class="text-md text-gray-400">{{ $product[1] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- View more -->
                <div class="flex justify-center items-center mt-12">
                    <a href="{{ route('humanShop.shoplist') }}"
                        class="text-2xl text-yellow-500 hover:underline font-semibold">View More ➔</a>
                </div>
            </section>
        </main>

        <!-- Other Detail Section -->
        <section class="bg-gray-800 text-gray-200 text-center p-10 border-t border-gray-700">
            <p class="max-w-4xl mx-auto text-lg leading-relaxed">Lorem ipsum dolor sit amet consectetur adipisicing
                elit. Quod numquam facilis fugit veritatis tempora maxime voluptates dolor, molestias labore vitae
                incidunt tenetur commodi est impedit eaque magnam sit omnis consequuntur.</p>
        </section>

        <!-- Promotion Section -->
        <section class="bg-yellow-500 text-gray-900 text-center py-12">
            <h2 class="text-4xl font-bold mb-6">Promotion เด็ดสำหรับลูกค้าใหม่ทุกท่าน</h2>
            <ul class="list-none text-2xl font-semibold space-y-2">
                <li>10%</li>
                <li>20%</li>
                <li>30%</li>
                <li>40%</li>
                <li>90%</li>
            </ul>
        </section>

        <!-- Footer Section -->
        <footer class="bg-gray-900 text-center text-sm text-gray-400 py-6 border-t border-gray-700">
            Human_shop Project Database • 2567 :: group22
        </footer>
    </div>
</body>

</html>