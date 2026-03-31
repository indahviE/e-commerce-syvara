<!-- Navbar Component -->
<nav class="no-print bg-white border-b border-pink-100 sticky top-0 z-50 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
        <!-- Logo -->
        <a href="/" class="text-2xl font-bold text-pink-600 flex items-center gap-2">
            <i class="fas fa-spa"></i> Syvara
        </a>

        <!-- Desktop Menu -->
        <div class="hidden md:flex items-center gap-8">
            <a href="/" class="text-gray-700 hover:text-pink-600 transition font-medium">Beranda</a>
            <a href="/about" class="text-gray-700 hover:text-pink-600 transition font-medium">Tentang</a>
            <a href="/product" class="text-gray-700 hover:text-pink-600 transition font-medium">Produk</a>
            @if (Auth::user() && Auth::user()->role == 'admin')
                <a href="/orders" class="text-gray-700 hover:text-pink-600 transition font-medium">Pesanan</a>
            @endif
            <a href="/category" class="text-gray-700 hover:text-pink-600 transition font-medium">Kategori</a>
            <a href="/contact" class="text-gray-700 hover:text-pink-600 transition font-medium">Contact</a>
        </div>

        <!-- Auth Section -->
        <div class="flex items-center gap-4">
            @auth
                <!-- Profile Dropdown (Desktop) -->
                <div class="relative group hidden md:block">
                    <!-- Trigger Button -->
                    <button class="flex items-center gap-3 hover:bg-pink-50 px-3 py-2 rounded-lg transition">
                        <div class="w-10 h-10 rounded-full bg-pink-100 flex items-center justify-center">
                            <i class="fas fa-user text-pink-600"></i>
                        </div>
                        <div class="text-left">
                            <p class="text-gray-700 font-medium text-sm">{{ auth()->user()->name }}</p>
                            <!-- Badge Role: Admin atau Member -->
                            <span
                                class="inline-block text-xs font-semibold rounded-full px-2 py-0.5 {{ auth()->user()->role === 'admin' ? 'bg-red-100 text-red-700' : 'bg-blue-100 text-blue-700' }}">
                                {{ auth()->user()->role === 'admin' ? 'Admin' : 'Member' }}
                            </span>
                        </div>
                        <i class="fas fa-chevron-down text-gray-500 ml-2 text-xs"></i>
                    </button>

                    <!-- Dropdown Content -->
                    <div
                        class="absolute right-0 mt-0 w-56 bg-white rounded-lg shadow-lg border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">

                        <!-- User Info Header -->
                        <div class="px-4 py-3 border-b border-gray-100 bg-pink-50">
                            <p class="text-gray-800 font-bold text-sm">{{ auth()->user()->name }}</p>
                            <p class="text-gray-600 text-xs">{{ auth()->user()->email }}</p>
                            <span
                                class="inline-block text-xs font-semibold rounded-full px-2 py-1 mt-2 {{ auth()->user()->role === 'admin' ? 'bg-red-200 text-red-800' : 'bg-blue-200 text-blue-800' }}">
                                {{ auth()->user()->role === 'admin' ? 'Admin' : 'Member' }}
                            </span>
                        </div>

                        <!-- Menu Items -->
                        <div class="py-2">
                            <!-- Profile Link -->
                            <a href="/profile"
                                class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-pink-50 transition">
                                <i class="fas fa-user-circle text-pink-600 w-5"></i>
                                <span class="font-medium text-sm">My Profile</span>
                            </a>

                            <!-- Settings Link -->
                            {{-- <a href="/settings"
                                class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-pink-50 transition">
                                <i class="fas fa-cog text-pink-600 w-5"></i>
                                <span class="font-medium text-sm">Settings</span>
                            </a> --}}

                            <!-- Admin Menu (Hanya jika admin) -->
                            @if (auth()->user()->role === 'admin')
                               

                                <a href="{{ route('admin.faqs.index') }}"
                                    class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-pink-50 transition">
                                    <i class="fas fa-question-circle text-pink-600 w-5"></i>
                                    <span class="font-medium text-sm">Kelola FAQ</span>
                                </a>

                                <a href="{{ route('admin.guides.index') }}"
                                    class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-pink-50 transition">
                                    <i class="fas fa-book text-pink-600 w-5"></i>
                                    <span class="font-medium text-sm">Kelola Panduan</span>
                                </a>

                                <a href="{{ route('admin.vouchers.index') }}"
                                    class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-pink-50 transition">
                                    <i class="fas fa-ticket-alt text-pink-600 w-5"></i>
                                    <span class="font-medium text-sm">Kelola Voucher</span>
                                </a>
                            @else
                                <!-- Member Menu (Hanya jika member) -->
                                <a href="/my-orders"
                                    class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-pink-50 transition border-t border-gray-100">
                                    <i class="fas fa-shopping-bag text-pink-600 w-5"></i>
                                    <span class="font-medium text-sm">My Orders</span>
                                </a>

                                <a href="/history"
                                    class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-pink-50 transition ">
                                    {{-- <i class="fas fa-shopping-bag text-pink-600 w-5"></i> --}}
                                    <svg class="text-pink-600" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="currentColor" fill-rule="evenodd" d="M12.75 11.38V6h-1.5v6l4.243 4.243l1.06-1.06zM12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10s-4.477 10-10 10"/></svg>
                                    <span class="font-medium text-sm">History Checkout</span>
                                </a>

                                <a href="/wishlist"
                                    class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-pink-50 transition relative">
                                    <i class="fas fa-heart text-pink-600 w-5"></i>
                                    <span class="font-medium text-sm">Wishlist</span>
                                    @if (auth()->user()->wishlists()->count() > 0)
                                        <span
                                            class="ml-auto bg-pink-600 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">
                                            {{ auth()->user()->wishlists()->count() }}
                                        </span>
                                    @endif
                                </a>
                            @endif
                        </div>

                        <!-- Divider -->
                        <div class="border-t border-gray-100"></div>

                        <!-- Logout Button -->
                        <form action="{{ route('logout') }}" method="POST" class="block">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center gap-3 px-4 py-3 text-red-600 hover:bg-red-50 transition font-medium text-sm">
                                <i class="fas fa-sign-out-alt w-5"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Mobile Menu Button (Mobile Only) -->
                <button class="md:hidden text-gray-700 hover:text-pink-600 transition relative">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-pink-100 flex items-center justify-center">
                            <i class="fas fa-user text-pink-600 text-sm"></i>
                        </div>
                    </div>
                </button>
            @else
                <!-- Login Button -->
                <a href="/login"
                    class="px-6 py-2 bg-pink-600 text-white rounded-lg font-semibold hover:bg-pink-700 transition">
                    <i class="fas fa-sign-in-alt mr-2"></i> Login
                </a>

                <!-- Register Button -->
                <a href="/register"
                    class="px-6 py-2 border-2 border-pink-600 text-pink-600 rounded-lg font-semibold hover:border-pink-700 hover:text-pink-700 transition hidden md:inline-block">
                    <i class="fas fa-user-plus mr-2"></i> Register
                </a>
            @endauth
        </div>

        <!-- Mobile Menu Toggle (Non-Auth) -->
        @guest
            <button class="md:hidden text-gray-700 hover:text-pink-600 transition">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        @endguest
    </div>
</nav>
