<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorit Saya - Syvara</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');

        * {
            font-family: 'Poppins', sans-serif;
        }

        .product-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .product-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 20px 40px rgba(236, 72, 153, 0.2);
        }

        .product-img {
            overflow: hidden;
            position: relative;
        }

        .product-img img {
            transition: transform 0.4s ease;
        }

        .product-card:hover .product-img img {
            transform: scale(1.08);
        }

        .wishlist-badge {
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

        @keyframes fadeOut {
            from {
                opacity: 1;
                transform: scale(1);
            }

            to {
                opacity: 0;
                transform: scale(0.95);
            }
        }

        .fade-out {
            animation: fadeOut 0.3s ease-out;
        }

        .gradient-text {
            background: linear-gradient(135deg, #ec4899 0%, #db2777 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .heart-icon {
            transition: all 0.3s ease;
        }

        .heart-icon:active {
            transform: scale(1.2);
        }
    </style>
</head>

<body class="bg-gradient-to-br from-pink-50 via-white to-pink-50">
    <x-navbar></x-navbar>

    <!-- Hero Section -->
    <section class="relative pt-12 pb-8 px-4 overflow-hidden">
        <div class="absolute inset-0 opacity-30">
            <div
                class="absolute top-10 left-10 w-64 h-64 bg-pink-200 rounded-full mix-blend-multiply filter blur-3xl animate-pulse">
            </div>
            <div class="absolute bottom-10 right-10 w-64 h-64 bg-rose-200 rounded-full mix-blend-multiply filter blur-3xl animate-pulse"
                style="animation-delay: 2s;"></div>
        </div>

        <div class="max-w-7xl mx-auto relative z-10">
            <div class="mb-8">
                <div class="flex items-center gap-3 mb-4">
                    <h3 class="text-4xl md:text-4xl font-bold gradient-text">Koleksi Favoritmu!</h3>
                </div>
                <p class="text-gray-600 text-lg md:text-xl max-w-2xl"> Simpan dan kelola koleksi favorit kamu di sini.
                </p>
            </div>
            <!-- Empty State -->
            @if (!$products || $products->isEmpty())
                <div class="flex justify-center items-center py-20">
                    <div class="text-center max-w-md">
                        <div class="mb-6 inline-block">
                            <div
                                class="w-32 h-32 bg-gradient-to-br from-pink-100 to-rose-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-heart text-6xl text-gray-300"></i>
                            </div>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-900 mb-3">Belum ada favorit</h2>
                        <p class="text-gray-600 text-lg mb-8">
                            Jelajahi koleksi produk kami dan tambahkan item favorit kamu untuk melihatnya di sini.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="/product"
                                class="inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-pink-500 to-rose-500 text-white rounded-xl font-semibold hover:shadow-lg transition duration-300">
                                <i class="fas fa-shopping-bag mr-2"></i> Jelajahi Produk
                            </a>
                            <a href="/"
                                class="inline-flex items-center justify-center px-8 py-4 bg-white border-2 border-pink-300 text-pink-600 rounded-xl font-semibold hover:bg-pink-50 transition duration-300">
                                <i class="fas fa-home mr-2"></i> Kembali Beranda
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <!-- Products Grid -->
                <div class="max-w-7xl mx-auto">
                        <div
                            class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 sm:gap-5">
                            @foreach ($products as $data)
                                <!-- Product Card -->
                                <div
                                    class="product-card group bg-white rounded-2xl overflow-hidden border border-pink-100 hover:border-pink-300 block">
                                    <!-- Product Image Container -->
                                    <a href="/product/{{ $data->id }}/detail">
                                        <div class="product-img relative h-48 sm:h-56 overflow-hidden">
                                            @if ($data->image)
                                                <img src="{{ asset('storage/' . $data->image) }}"
                                                    alt="{{ $data->name }}">
                                            @else
                                                <div
                                                    class="w-full h-full flex items-center justify-center bg-gradient-to-br from-pink-100 to-rose-100">
                                                    <i class="fas fa-image text-4xl text-pink-300"></i>
                                                </div>
                                            @endif

                                            <!-- Overlay Gradient -->
                                            <div
                                                class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition duration-300">
                                            </div>

                                            <!-- Badges -->
                                            <div class="absolute top-3 left-3 right-3 flex justify-between items-start">
                                                @if ($data->created_at->diffInHours(now()) < 3)
                                                    <span
                                                        class="badge-new bg-gradient-to-r from-pink-500 to-rose-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                                                        ✨ NEW
                                                    </span>
                                                @endif

                                                @if ($data->stock < 5 && $data->stock > 0)
                                                    <span
                                                        class="stock-low bg-orange-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                                                        Terbatas
                                                    </span>
                                                @elseif ($data->stock == 0)
                                                    <span
                                                        class="bg-red-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">
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
                                                    title="Tambah ke favorit">
                                                    <i
                                                        class="fas fa-heart {{ $data->isWishlisted() ? 'fas text-pink-600' : 'far text-gray-400' }} text-lg"></i>
                                                </button>
                                            @else
                                                <a href="/login" onclick="event.stopPropagation();"
                                                    class="absolute top-3 right-3 w-10 h-10 bg-white rounded-full shadow-lg flex items-center justify-center hover:bg-pink-50 transition z-10"
                                                    title="Login untuk favorit">
                                                    <i class="far fa-heart text-gray-400 text-lg"></i>
                                                </a>
                                            @endauth
                                        </div>

                                        <!-- Product Info -->
                                        <div class="p-4">
                                            <!-- Category Badge -->
                                            <div class="mb-2">
                                                <span
                                                    class="inline-block text-xs font-bold text-pink-600 bg-pink-50 px-2.5 py-1 rounded-full border border-pink-200">
                                                    {{ $data->category->category_name ?? 'Produk' }}
                                                </span>
                                            </div>

                                            <!-- Product Name -->
                                            <h3
                                                class="font-bold text-gray-900 text-sm line-clamp-2 mb-2 group-hover:text-pink-600 transition">
                                                {{ $data->name }}
                                            </h3>

                                            <!-- Price -->
                                            <p class="gradient-text font-bold text-lg mb-3">
                                                Rp {{ number_format($data->price, 0, ',', '.') }}
                                            </p>
                                    </a>

                                    <!-- Stock Info -->
                                    <div class="flex items-center justify-between text-xs text-gray-600 mb-3">
                                        <span class="flex items-center gap-1">
                                            <i class="fas fa-box text-pink-500"></i>
                                            Stok: <strong class="text-gray-900">{{ $data->stock }}</strong>
                                        </span>
                                        <span
                                            class="text-pink-500 font-semibold group-hover:text-pink-600 opacity-0 group-hover:opacity-100 transition">→</span>
                                    </div>

                                    <form action="{{ route('show_single_payment') }}" method="post" class="flex gap-2">
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

                                        <button type="button"
                                            onclick="addToCart('{{ route('cart_product_add') }}', '{{ $data->id }}')"
                                            class="w-fit px-4 py-2.5 bg-gradient-to-r from-pink-500 to-rose-500 text-white rounded-lg font-semibold text-center hover:shadow-lg transition duration-300 text-sm">
                                            <i class="fas fa-shopping-bag mr-1"></i>
                                        </button>
                                    </form>
                                </div>
                        </div>
                    @endforeach
                </div>

    </section>

    <!-- Main Content -->
    <section class=" px-4">
        <div class="max-w-7xl mx-auto">
            <!-- Stats -->
            <div class="flex flex-wrap gap-4">
                <div class="bg-white/80 backdrop-blur-sm rounded-xl px-6 py-3 border border-pink-200">
                    <p class="text-sm text-gray-600">Total Favorit</p>
                    <p class="text-2xl font-bold text-pink-600">
                        @if ($products && $products->count() > 0)
                            {{ $products->count() }}
                        @else
                            0
                        @endif
                    </p>
                </div>
                <div class="bg-white/80 backdrop-blur-sm rounded-xl px-6 py-3 border border-pink-200">
                    <p class="text-sm text-gray-600">Total Harga</p>
                    <p class="text-2xl font-bold text-pink-600">
                        @if ($products && $products->count() > 0)
                            Rp {{ number_format($products->sum('price'), 0, ',', '.') }}
                        @else
                            Rp 0
                        @endif
                    </p>
                </div>
            </div>
        </div>
        <!-- Back to Shopping -->
        <div class="mt-16 text-center mb-16">
            <p class="text-gray-600 mb-6">Ingin menambah lebih banyak favorit?</p>
            <a href="/product"
                class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-pink-500 to-rose-500 text-white rounded-xl font-semibold hover:shadow-lg transition duration-300">
                <i class="fas fa-shopping-bag"></i> Lanjutkan Belanja
            </a>
        </div>
        @endif
        </div>
    </section>

    <x-footer></x-footer>

    <!-- Meta CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Script untuk remove dari wishlist -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Remove from wishlist
            document.querySelectorAll('.wishlist-btn').forEach(btn => {
                btn.addEventListener('click', async (e) => {
                    e.preventDefault();
                    e.stopPropagation();

                    const productId = btn.dataset.productId;

                    try {
                        const response = await fetch(`/wishlist/toggle/${productId}`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').content,
                                'Content-Type': 'application/json'
                            }
                        });

                        const data = await response.json();

                        if (data.status === 'removed') {
                            // Animate card removal
                            const card = btn.closest('.product-card');
                            card.classList.add('fade-out');

                            setTimeout(() => {
                                card.remove();

                                // Check if no more products
                                const remainingCards = document.querySelectorAll(
                                    '.product-card');
                                if (remainingCards.length === 0) {
                                    location.reload();
                                }
                            }, 300);

                            // Show notification
                            showNotification('Dihapus dari favorit', 'success');
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        showNotification('Gagal menghapus dari favorit', 'error');
                    }
                });
            });

            // Add to cart
            document.querySelectorAll('.add-to-cart').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    const productId = btn.dataset.productId;
                    showNotification('Produk ditambahkan ke keranjang!', 'success');
                    // Implement actual cart logic here
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
            padding: 16px 24px;
            border-radius: 12px;
            z-index: 9999;
            font-weight: 600;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            animation: slideInUp 0.3s ease-out;
        `;

            document.body.appendChild(notification);

            setTimeout(() => {
                notification.style.animation = 'slideOutDown 0.3s ease-out';
                setTimeout(() => notification.remove(), 300);
            }, 3000);
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
