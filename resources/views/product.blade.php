<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semua Produk - Syvara</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');
        * { font-family: 'Poppins', sans-serif; }

        .product-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 20px 40px rgba(236, 72, 153, 0.2);
        }

        .product-img {
            overflow: hidden;
            position: relative;
            background: linear-gradient(135deg, #fce7f3 0%, #fbcfe8 100%);
        }

        .product-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .product-card:hover .product-img img {
            transform: scale(1.1);
        }

        .badge-new {
            animation: slideInRight 0.5s ease-out;
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .heart-btn {
            transition: all 0.2s ease;
        }

        .heart-btn:active {
            transform: scale(1.15);
        }

        .stock-low {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.8; }
        }

        .gradient-text {
            background: linear-gradient(135deg, #ec4899 0%, #db2777 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-pink-50 via-white to-pink-50">
    <x-navbar></x-navbar>

    <!-- Hero Section -->
    <section class="relative pt-8 pb-6 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="bg-pink-500 rounded-3xl p-8 sm:p-12 shadow-xl">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                    <div>
                        <h1 class="text-4xl md:text-5xl font-bold mb-3 text-white flex items-center gap-3">
                            <i class="fas fa-sparkles"></i>Semua Produk
                        </h1>
                        <p class="text-pink-100 text-lg">Koleksi skincare premium terlengkap untuk kulit sehat Anda</p>
                    </div>
                    <a href="/about" class="inline-flex items-center gap-2 px-8 py-4 bg-white text-pink-600 rounded-xl font-bold hover:bg-pink-50 hover:shadow-lg transition duration-300 whitespace-nowrap">
                        <i class="fas fa-info-circle"></i> Pelajari Lebih
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Grid -->
    <section class="py-12 px-4">
        <div class="max-w-7xl mx-auto">
            @if ($products->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 sm:gap-5">
                    @foreach ($products as $data)
                        <!-- Product Card -->
                        <a href="/product/{{ $data->id }}/detail" class="product-card group bg-white rounded-2xl overflow-hidden border border-pink-100 hover:border-pink-300 block">
                            <!-- Product Image Container -->
                            <div class="product-img relative h-48 sm:h-56 overflow-hidden">
                                @if ($data->image)
                                    <img src="{{ asset('storage/' . $data->image) }}" alt="{{ $data->name }}">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-pink-100 to-rose-100">
                                        <i class="fas fa-image text-4xl text-pink-300"></i>
                                    </div>
                                @endif

                                <!-- Overlay Gradient -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition duration-300"></div>

                                <!-- Badges -->
                                <div class="absolute top-3 left-3 right-3 flex justify-between items-start">
                                    @if ($data->created_at->diffInHours(now()) < 3)
                                        <span class="badge-new bg-gradient-to-r from-pink-500 to-rose-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                                            ✨ NEW
                                        </span>
                                    @endif

                                    @if ($data->stock < 5 && $data->stock > 0)
                                        <span class="stock-low bg-orange-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                                            Terbatas
                                        </span>
                                    @elseif ($data->stock == 0)
                                        <span class="bg-red-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                                            Habis
                                        </span>
                                    @endif
                                </div>

                                <!-- Wishlist Button (Top Right) -->
                                @auth
                                    <button
                                        class="wishlist-btn heart-btn absolute top-3 right-3 w-10 h-10 bg-white rounded-full shadow-lg flex items-center justify-center hover:bg-pink-50 transition z-10"
                                        data-product-id="{{ $data->id }}"
                                        onclick="event.preventDefault(); event.stopPropagation();"
                                        title="Tambah ke favorit"
                                    >
                                        <i class="fas fa-heart {{ $data->isWishlisted() ? 'fas text-pink-600' : 'far text-gray-400' }} text-lg"></i>
                                    </button>
                                @else
                                    <a href="/login" onclick="event.stopPropagation();" class="absolute top-3 right-3 w-10 h-10 bg-white rounded-full shadow-lg flex items-center justify-center hover:bg-pink-50 transition z-10" title="Login untuk favorit">
                                        <i class="far fa-heart text-gray-400 text-lg"></i>
                                    </a>
                                @endauth
                            </div>

                            <!-- Product Info -->
                            <div class="p-4">
                                <!-- Category Badge -->
                                <div class="mb-2">
                                    <span class="inline-block text-xs font-bold text-pink-600 bg-pink-50 px-2.5 py-1 rounded-full border border-pink-200">
                                        {{ $data->category->category_name ?? 'Produk' }}
                                    </span>
                                </div>

                                <!-- Product Name -->
                                <h3 class="font-bold text-gray-900 text-sm line-clamp-2 mb-2 group-hover:text-pink-600 transition">
                                    {{ $data->name }}
                                </h3>

                                <!-- Price -->
                                <p class="gradient-text font-bold text-lg mb-3">
                                    Rp {{ number_format($data->price, 0, ',', '.') }}
                                </p>

                                <!-- Stock Info -->
                                <div class="flex items-center justify-between text-xs text-gray-600 mb-3">
                                    <span class="flex items-center gap-1">
                                        <i class="fas fa-box text-pink-500"></i>
                                        Stok: <strong class="text-gray-900">{{ $data->stock }}</strong>
                                    </span>
                                    <span class="text-pink-500 font-semibold group-hover:text-pink-600 opacity-0 group-hover:opacity-100 transition">→</span>
                                </div>
                                
                                <div class="flex gap-2">
                                    <!-- Add to Cart Button -->
                                    <button onclick="event.preventDefault();" class="from-pink-50 to-rose-50 text-pink-600 rounded-xl font-semibold hover:from-pink-100 hover:to-rose-100 transition duration-300 text-center text-sm border border-pink-200 w-full">
                                         Checkout
                                    </button>
                                    <button onclick="event.preventDefault();" class="w-fit px-4 py-2.5 bg-gradient-to-r from-pink-500 to-rose-500 text-white rounded-lg font-semibold text-center hover:shadow-lg transition duration-300 text-sm">
                                        <i class="fas fa-shopping-bag mr-1"></i>
                                    </button>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="flex justify-center items-center py-20">
                    <div class="text-center max-w-md">
                        <div class="mb-6 inline-block">
                            <div class="w-32 h-32 bg-gradient-to-br from-pink-100 to-rose-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-inbox text-6xl text-gray-300"></i>
                            </div>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">Produk Tidak Ditemukan</h2>
                        <p class="text-gray-600 mb-6">Maaf, tidak ada produk yang sesuai dengan pencarian Anda.</p>
                        <a href="/" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-pink-500 to-rose-500 text-white rounded-lg font-bold hover:shadow-lg transition duration-300">
                            <i class="fas fa-home"></i> Kembali Beranda
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <x-footer></x-footer>

    <!-- Wishlist Toggle Script -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.wishlist-btn').forEach(btn => {
            btn.addEventListener('click', async (e) => {
                e.preventDefault();
                e.stopPropagation();

                const productId = btn.dataset.productId;

                try {
                    const response = await fetch(`/wishlist/toggle/${productId}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Content-Type': 'application/json'
                        }
                    });

                    const data = await response.json();

                    if (data.status === 'added') {
                        btn.innerHTML = '<i class="fas fa-heart text-pink-600 text-lg"></i>';
                        showNotification('Ditambahkan ke favorit', 'success');
                    } else {
                        btn.innerHTML = '<i class="far fa-heart text-gray-400 text-lg"></i>';
                        showNotification('Dihapus dari favorit', 'info');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    showNotification('Gagal update favorit', 'error');
                }
            });
        });
    });

    // Notification function
    function showNotification(message, type = 'info') {
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
</body>
</html>
