<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $category->category_name }} - Syavara</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');

        * {
            font-family: 'Poppins', sans-serif;
        }

        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 16px rgba(236, 72, 153, 0.1);
        }

        .product-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .product-card:hover .product-img img {
            transform: scale(1.05);
        }
    </style>
</head>

<body class="bg-gray-50">
    <x-navbar></x-navbar>

    <!-- Header -->
    <section class="py-8 px-4 bg-gradient-to-r from-pink-50 to-pink-100">
        <div class="max-w-7xl mx-auto">
            <div class="bg-gradient-to-br from-pink-500 to-pink-600 rounded-2xl p-8 shadow-lg">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                    <div>
                        <a href="/category"
                            class="text-pink-100 hover:text-white mb-3 inline-flex items-center gap-2 text-sm font-semibold">
                            <i class="fas fa-arrow-left"></i> Kembali ke Kategori
                        </a>
                        <h1 class="text-4xl md:text-5xl font-bold text-white mb-2">{{ $category->category_name }}</h1>
                        <p class="text-pink-100">{{ $products->count() }} produk tersedia dalam kategori ini</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Grid -->
    <section class="py-12 px-4">
        <div class="max-w-7xl mx-auto">
            @if ($products->count() > 0)
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3 sm:gap-4">
                    @foreach ($products as $data)
                        <!-- PRODUCT CARD -->
                        <div
                            class="product-card group bg-white rounded-xl overflow-hidden border border-pink-100 hover:border-pink-300 transition-all">
                            <a href="/product/{{ $data->id }}/detail">
                                <div class="product-img relative h-32 sm:h-40 bg-pink-50 overflow-hidden">
                                    @if ($data->image)
                                        <img src="{{ asset('storage/' . $data->image) }}" alt="{{ $data->name }}">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-pink-50">
                                            <i class="fas fa-image text-2xl text-pink-200"></i>
                                        </div>
                                    @endif

                                    {{-- NEW BADGE - Muncul jika produk ditambah kurang dari 3 jam --}}
                                    @if ($data->created_at->diffInHours(now()) < 3)
                                        <span
                                            class="absolute top-1 right-1 bg-pink-500 text-white px-2 py-0.5 rounded text-xs font-bold">NEW</span>
                                    @endif
                                </div>

                                <div class="p-2.5 sm:p-3">
                                    <div class="mb-2">
                                        <span
                                            class="inline-block text-xs font-bold text-pink-600 bg-pink-50 px-2.5 py-1 rounded-full border border-pink-200">
                                            {{ $category->category_name ?? 'Produk' }}
                                        </span>
                                    </div>
                                    <h3 class="font-bold text-gray-900 text-xs sm:text-sm line-clamp-2 mb-1">
                                        {{ $data->name }}</h3>
                                    <p class="text-pink-600 font-bold text-xs sm:text-sm mb-2">Rp
                                        {{ number_format($data->price, 0, ',', '.') }}</p>

                                    <div class="flex justify-between items-center text-xs text-gray-600">
                                        <span>Stok: {{ $data->stock }}</span>
                                        <span
                                            class="text-pink-500 font-semibold group-hover:text-pink-600 opacity-0 group-hover:opacity-100 transition">→</span>
                                    </div>
                                </div>
                            </a>

                            <form action="{{ route('show_single_payment') }}" method="post" class="flex gap-2 p-3">
                                <!-- Add to Cart Button -->
                                @csrf
                                <select name="qty" id="">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                </select>
                                <input type="text" value="{{ $data->id }}" name="produk_id" hidden>
                                <button type="submit"
                                    class="from-pink-50 to-rose-50 text-pink-600 rounded-xl font-semibold hover:from-pink-100 hover:to-rose-100 transition duration-300 text-center text-sm border border-pink-200 w-full">
                                    Checkout
                                </button>
                                <button onclick="addToCart('{{ route('cart_product_add') }}', '{{ $data->id }}')"
                                    class="w-fit px-4 py-2.5 bg-gradient-to-r from-pink-500 to-rose-500 text-white rounded-lg font-semibold text-center hover:shadow-lg transition duration-300 text-sm">
                                    <i class="fas fa-shopping-bag mr-1"></i>
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-2xl shadow-lg p-12 text-center border border-gray-100">
                    <i class="fas fa-box-open text-6xl text-gray-300 mb-4 block"></i>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Belum Ada Produk</h3>
                    <p class="text-gray-500 mb-6">Kategori ini belum memiliki produk</p>
                    <a href="/category"
                        class="inline-flex items-center gap-2 px-6 py-3 bg-pink-500 text-white rounded-lg font-semibold hover:bg-pink-600 transition duration-300">
                        <i class="fas fa-arrow-left"></i>
                        Kembali ke Kategori
                    </a>
                </div>
            @endif
        </div>
    </section>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <x-footer></x-footer>
    <script>
        // Notification function
        function showNotification(message, type = 'info') {
            // e.preventDefault();
            const notification = document.createElement('div');
            notification.textContent = message;

            const bgColor = type === 'success' ? '#10b981' : type === 'error' ? '#ef4444' : '#3b82f6';

            notification.style.cssText = `
position: fixed;
bottom: 30px;
right: 20px;
background: ${bgColor};
color: white;
padding: 14px 20px;
border-radius: 10px;
z-index: 9999;
font-weight: 600;
font-size: 14px;
box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
animation: slideInUp 0.3s ease-out;
`;

            document.body.appendChild(notification);

            setTimeout(() => {
                notification.style.animation = 'slideOutDown 0.3s ease-out';
                setTimeout(() => notification.remove(), 300);
            }, 2500);
        }

        // Add animation styles
        const style = document.createElement('style');
        style.textContent = `
@keyframes slideInUp {
from {
transform: translateY(20px);
opacity: 0;
}
to {
transform: translateY(0);
opacity: 1;
}
}

@keyframes slideOutDown {
from {
transform: translateY(0);
opacity: 1;
}
to {
transform: translateY(20px);
opacity: 0;
}
}
`;
        document.head.appendChild(style);
    </script>
    <script src="{{ asset('storage/js/functionBackend.js') }}"></script>
</body>

</html>
