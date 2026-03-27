<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang - Syvara</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{asset('storage/css/payment.css')}}">
</head>

<body>

    <!-- NAVBAR -->
    <x-navbar></x-navbar>

    <!-- HERO -->
    {{-- <section class="relative pt-8 pb-6 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="bg-pink-500 rounded-3xl p-8 sm:p-12 shadow-xl">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                    <div>
                        <h1 class="text-4xl md:text-5xl font-bold mb-3 text-white flex items-center gap-3">
                            Keranjang Anda
                        </h1>
                        <p class="text-pink-100 text-lg">Berikan informasi detail untuk melakukan pengiriman produk yang dipesan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- MAIN CONTENT -->
    <div class="cart-container">

        <!-- LEFT: CART ITEMS -->
        <div class="mb-16">
            <div class="card">
                <div class="card-header">
                    <h2><span class="dot"></span> Daftar Produk dalam Keranjang</h2>
                    <span style="font-size:0.8rem;color:var(--text-gray);">5 item</span>
                </div>

                <!-- SELECT ALL -->
                <div class="select-all-row">
                    <input type="checkbox" class="custom-check" id="selectAll" checked onchange="toggleAll(this)">
                    <label for="selectAll" style="cursor:pointer;">Pilih Semua</label>
                    <span style="margin-left:auto;color:#EF4444;font-size:0.82rem;cursor:pointer;font-weight:600;"
                        onclick="deleteSelected()">🗑 Hapus Dipilih</span>
                </div>

                <!-- ITEM 1 -->
                <div class="cart-item" id="item-1">
                    <div class="item-check">
                        <input type="checkbox" class="custom-check item-checkbox" checked onchange="updateSummary()">
                    </div>
                    <div
                        style="width:90px;height:90px;border-radius:14px;background:var(--pink-light);flex-shrink:0;display:flex;align-items:center;justify-content:center;border:1.5px solid var(--border);">
                        <img src="{{ asset('images/products/centella-serum.jpg') }}" onerror="this.style.display='none'"
                            alt="Centella Serum" class="item-image" style="width:90px;height:90px;position:absolute;">
                        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#FFAFD4"
                            stroke-width="1.5">
                            <path d="M9 3h6l1 4H8L9 3z" />
                            <path d="M8 7v13a1 1 0 001 1h6a1 1 0 001-1V7" />
                            <path d="M10 11v6M14 11v6" />
                        </svg>
                    </div>
                    <div class="item-info">
                        <span class="item-badge">Hydration</span>
                        <div class="item-name">SKIN1004 Centella Asiatica Serum</div>
                        <div class="item-stock">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M20 7H4a2 2 0 00-2 2v10a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z" />
                                <path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16" />
                            </svg>
                            Stok: 11
                        </div>
                        <div class="item-bottom">
                            <div>
                                <div class="item-price">Rp 150.000</div>
                                <div class="item-subtotal" id="subtotal-1">Subtotal: Rp 150.000</div>
                            </div>
                            <div class="qty-control">
                                <button class="qty-btn"
                                    onclick="changeQty('qty-1', -1, 150000, 'subtotal-1')">−</button>
                                <input type="number" id="qty-1" class="qty-input" value="1" min="1"
                                    max="11" onchange="calcSubtotal('qty-1', 150000, 'subtotal-1')">
                                <button class="qty-btn" onclick="changeQty('qty-1', 1, 150000, 'subtotal-1')">+</button>
                            </div>
                        </div>
                    </div>
                    <button class="btn-delete" onclick="removeItem('item-1')" title="Hapus">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M3 6h18M8 6V4h8v2M19 6l-1 14H6L5 6" />
                        </svg>
                    </button>
                </div>

                <!-- ITEM 2 -->
                <div class="cart-item" id="item-2">
                    <div class="item-check">
                        <input type="checkbox" class="custom-check item-checkbox" checked onchange="updateSummary()">
                    </div>
                    <div
                        style="width:90px;height:90px;border-radius:14px;background:var(--pink-light);flex-shrink:0;display:flex;align-items:center;justify-content:center;border:1.5px solid var(--border);">
                        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#FFAFD4"
                            stroke-width="1.5">
                            <circle cx="12" cy="12" r="9" />
                            <path d="M12 7v5l3 3" />
                        </svg>
                    </div>
                    <div class="item-info">
                        <span class="item-badge">Brightening</span>
                        <div class="item-name">Skin1004 Madagascar Centella Brightening Serum</div>
                        <div class="item-stock">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M20 7H4a2 2 0 00-2 2v10a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z" />
                                <path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16" />
                            </svg>
                            Stok: 100
                        </div>
                        <div class="item-bottom">
                            <div>
                                <div class="item-price">Rp 150.000</div>
                                <div class="item-subtotal" id="subtotal-2">Subtotal: Rp 300.000</div>
                            </div>
                            <div class="qty-control">
                                <button class="qty-btn"
                                    onclick="changeQty('qty-2', -1, 150000, 'subtotal-2')">−</button>
                                <input type="number" id="qty-2" class="qty-input" value="2"
                                    min="1" max="100"
                                    onchange="calcSubtotal('qty-2', 150000, 'subtotal-2')">
                                <button class="qty-btn"
                                    onclick="changeQty('qty-2', 1, 150000, 'subtotal-2')">+</button>
                            </div>
                        </div>
                    </div>
                    <button class="btn-delete" onclick="removeItem('item-2')" title="Hapus">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M3 6h18M8 6V4h8v2M19 6l-1 14H6L5 6" />
                        </svg>
                    </button>
                </div>

                <!-- ITEM 3 -->
                <div class="cart-item" id="item-3">
                    <div class="item-check">
                        <input type="checkbox" class="custom-check item-checkbox" checked onchange="updateSummary()">
                    </div>
                    <div
                        style="width:90px;height:90px;border-radius:14px;background:var(--pink-light);flex-shrink:0;display:flex;align-items:center;justify-content:center;border:1.5px solid var(--border);">
                        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#FFAFD4"
                            stroke-width="1.5">
                            <path d="M7 17C7 14.8 8.6 13 10.5 13H13.5C15.4 13 17 14.8 17 17" />
                            <path d="M12 13V7M9 10l3-3 3 3" />
                        </svg>
                    </div>
                    <div class="item-info">
                        <span class="item-badge haircare">Hair Care</span>
                        <div class="item-name">Kerastase Genesis Bain Nutri-Fortifiant Anti Hair-Fortifying Shampoo
                        </div>
                        <div class="item-stock">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M20 7H4a2 2 0 00-2 2v10a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z" />
                                <path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16" />
                            </svg>
                            Stok: 200
                        </div>
                        <div class="item-bottom">
                            <div>
                                <div class="item-price">Rp 1.053.731</div>
                                <div class="item-subtotal" id="subtotal-3">Subtotal: Rp 1.053.731</div>
                            </div>
                            <div class="qty-control">
                                <button class="qty-btn"
                                    onclick="changeQty('qty-3', -1, 1053731, 'subtotal-3')">−</button>
                                <input type="number" id="qty-3" class="qty-input" value="1"
                                    min="1" max="200"
                                    onchange="calcSubtotal('qty-3', 1053731, 'subtotal-3')">
                                <button class="qty-btn"
                                    onclick="changeQty('qty-3', 1, 1053731, 'subtotal-3')">+</button>
                            </div>
                        </div>
                    </div>
                    <button class="btn-delete" onclick="removeItem('item-3')" title="Hapus">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M3 6h18M8 6V4h8v2M19 6l-1 14H6L5 6" />
                        </svg>
                    </button>
                </div>

                <!-- ITEM 4 -->
                <div class="cart-item" id="item-4">
                    <div class="item-check">
                        <input type="checkbox" class="custom-check item-checkbox" onchange="updateSummary()">
                    </div>
                    <div
                        style="width:90px;height:90px;border-radius:14px;background:var(--pink-light);flex-shrink:0;display:flex;align-items:center;justify-content:center;border:1.5px solid var(--border);">
                        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#FFAFD4"
                            stroke-width="1.5">
                            <path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10 10-4.5 10-10S17.5 2 12 2z" />
                            <path d="M12 8v4l3 3" />
                        </svg>
                    </div>
                    <div class="item-info">
                        <span class="item-badge">Hydration</span>
                        <div class="item-name">COSRX Salicylic Acid Daily Gentle Cleanser</div>
                        <div class="item-stock">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M20 7H4a2 2 0 00-2 2v10a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z" />
                                <path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16" />
                            </svg>
                            Stok: 100
                        </div>
                        <div class="item-bottom">
                            <div>
                                <div class="item-price">Rp 117.000</div>
                                <div class="item-subtotal" id="subtotal-4">Subtotal: Rp 117.000</div>
                            </div>
                            <div class="qty-control">
                                <button class="qty-btn"
                                    onclick="changeQty('qty-4', -1, 117000, 'subtotal-4')">−</button>
                                <input type="number" id="qty-4" class="qty-input" value="1"
                                    min="1" max="100"
                                    onchange="calcSubtotal('qty-4', 117000, 'subtotal-4')">
                                <button class="qty-btn"
                                    onclick="changeQty('qty-4', 1, 117000, 'subtotal-4')">+</button>
                            </div>
                        </div>
                    </div>
                    <button class="btn-delete" onclick="removeItem('item-4')" title="Hapus">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M3 6h18M8 6V4h8v2M19 6l-1 14H6L5 6" />
                        </svg>
                    </button>
                </div>

                <!-- ITEM 5 -->
                <div class="cart-item" id="item-5">
                    <div class="item-check">
                        <input type="checkbox" class="custom-check item-checkbox" checked onchange="updateSummary()">
                    </div>
                    <div
                        style="width:90px;height:90px;border-radius:14px;background:var(--pink-light);flex-shrink:0;display:flex;align-items:center;justify-content:center;border:1.5px solid var(--border);">
                        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#FFAFD4"
                            stroke-width="1.5">
                            <path d="M9 3h6l1 4H8L9 3z" />
                            <path d="M8 7v13a1 1 0 001 1h6a1 1 0 001-1V7" />
                        </svg>
                    </div>
                    <div class="item-info">
                        <span class="item-badge">Hydration</span>
                        <div class="item-name">Skin1004 Madagascar Centella Asiatica Toner</div>
                        <div class="item-stock">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M20 7H4a2 2 0 00-2 2v10a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z" />
                                <path d="M16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16" />
                            </svg>
                            Stok: 200
                        </div>
                        <div class="item-bottom">
                            <div>
                                <div class="item-price">Rp 130.000</div>
                                <div class="item-subtotal" id="subtotal-5">Subtotal: Rp 130.000</div>
                            </div>
                            <div class="qty-control">
                                <button class="qty-btn"
                                    onclick="changeQty('qty-5', -1, 130000, 'subtotal-5')">−</button>
                                <input type="number" id="qty-5 w-8 text-gray-800" class="qty-input" value="1"
                                    min="1" max="200"
                                    onchange="calcSubtotal('qty-5', 130000, 'subtotal-5')">
                                <button class="qty-btn"
                                    onclick="changeQty('qty-5', 1, 130000, 'subtotal-5')">+</button>
                            </div>
                        </div>
                    </div>
                    <button class="btn-delete" onclick="removeItem('item-5')" title="Hapus">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M3 6h18M8 6V4h8v2M19 6l-1 14H6L5 6" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- REKOMENDASI -->
            {{-- <div class="card rekomen-section" style="margin-top:1.25rem;">
                <div class="rekomen-header">
                    ✨ Produk Pilihan Untukmu
                </div>
                <div class="rekomen-list">
                    <div class="rekomen-item">
                        <div
                            style="width:100%;height:90px;background:var(--pink-light);display:flex;align-items:center;justify-content:center;">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#FFAFD4"
                                stroke-width="1.5">
                                <circle cx="12" cy="12" r="9" />
                            </svg>
                        </div>
                        <div class="rekomen-info">
                            <div class="rekomen-name">La Mer The Essence Foaming</div>
                            <div class="rekomen-price">Rp 2.500.000</div>
                            <button class="btn-add-mini">+ Keranjang</button>
                        </div>
                    </div>
                    <div class="rekomen-item">
                        <div
                            style="width:100%;height:90px;background:#FFF0E6;display:flex;align-items:center;justify-content:center;">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#FFB87A"
                                stroke-width="1.5">
                                <path d="M12 2L2 7l10 5 10-5-10-5z" />
                                <path d="M2 17l10 5 10-5" />
                            </svg>
                        </div>
                        <div class="rekomen-info">
                            <div class="rekomen-name">The Ordinary Niacinamide 10%</div>
                            <div class="rekomen-price">Rp 185.000</div>
                            <button class="btn-add-mini">+ Keranjang</button>
                        </div>
                    </div>
                    <div class="rekomen-item">
                        <div
                            style="width:100%;height:90px;background:var(--pink-light);display:flex;align-items:center;justify-content:center;">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#FFAFD4"
                                stroke-width="1.5">
                                <path d="M12 22C17.5 22 22 17.5 22 12S17.5 2 12 2 2 6.5 2 12s4.5 10 10 10z" />
                            </svg>
                        </div>
                        <div class="rekomen-info">
                            <div class="rekomen-name">Laneige Lip Sleeping Mask</div>
                            <div class="rekomen-price">Rp 350.000</div>
                            <button class="btn-add-mini">+ Keranjang</button>
                        </div>
                    </div>
                    <div class="rekomen-item">
                        <div
                            style="width:100%;height:90px;background:var(--pink-light);display:flex;align-items:center;justify-content:center;">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#FFAFD4"
                                stroke-width="1.5">
                                <path d="M9 3h6l1 4H8L9 3z" />
                                <path d="M8 7v13h8V7" />
                            </svg>
                        </div>
                        <div class="rekomen-info">
                            <div class="rekomen-name">SOME BY MI AHA BHA Toner</div>
                            <div class="rekomen-price">Rp 220.000</div>
                            <button class="btn-add-mini">+ Keranjang</button>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>

        {{-- ── HTML ────────────────────────────────────────────────── --}}
        <div>
            <div class="card summary-card">
                <div class="card-header">
                    <h2><span class="dot"></span> Ringkasan Pesanan</h2>
                </div>

                {{-- Mini pill summary --}}
                <div class="detail-summary-badge">
                    <span class="detail-pill" onclick="openDetailPanel('alamat')">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path
                                d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5s2.5 1.12 2.5 2.5S13.38 11.5 12 11.5z" />
                        </svg>
                        <span id="pill-alamat">+ Alamat</span>
                    </span>
                    <span class="detail-pill" onclick="openDetailPanel('payment')">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <rect x="2" y="5" width="20" height="14" rx="3" />
                            <path d="M2 10h20" />
                        </svg>
                        <span id="pill-payment">+ Pembayaran</span>
                    </span>
                    <span class="detail-pill" onclick="openDetailPanel('pengiriman')">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path d="M5 17H3a2 2 0 01-2-2V5a2 2 0 012-2h11a2 2 0 012 2v3M13 17h8l-3-6H13V7" />
                            <circle cx="7.5" cy="18.5" r="1.5" />
                            <circle cx="17.5" cy="18.5" r="1.5" />
                        </svg>
                        <span id="pill-pengiriman">+ Pengiriman</span>
                    </span>
                </div>

                <div class="summary-body">
                    <!-- KODE PROMO -->
                    <div class="promo-input-group">
                        <input type="text" class="promo-input" placeholder="Kode promo / voucher" id="promoCode">
                        <button class="btn-promo" onclick="applyPromo()">Pakai</button>
                    </div>

                    <!-- RINCIAN -->
                    <div class="summary-row">
                        <span>Subtotal (<span id="item-count">4</span> item)</span>
                        <span id="summary-subtotal">Rp 1.633.731</span>
                    </div>
                    <div class="summary-row discount" id="discount-row" style="display:none;">
                        <span>🏷 Diskon Promo</span>
                        <span id="discount-amount">−Rp 0</span>
                    </div>
                    <div class="summary-row shipping">
                        <span>Ongkos Kirim</span>
                        <span id="shipping-cost-display">Rp 15.000</span>
                    </div>
                    <div class="summary-row">
                        <span>Biaya Layanan</span>
                        <span>Rp 2.000</span>
                    </div>

                    <hr class="summary-divider">

                    <div class="summary-total">
                        <span>Total Pembayaran</span>
                        <span class="total-price" id="summary-total">Rp 1.650.731</span>
                    </div>

                    <button class="btn-checkout" onclick="handleCheckout()">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5">
                            <path
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        Checkout Sekarang
                    </button>

                    <button class="btn-detail-order" onclick="openDetailPanel('alamat')">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5">
                            <circle cx="12" cy="12" r="10" />
                            <path d="M12 8v4l3 3" />
                        </svg>
                        Atur Detail Pesanan
                    </button>

                    <a href="{{ route('productMember') }}" class="btn-continue">← Lanjut Belanja</a>

                    <div class="guarantee-row">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        Pembayaran 100% aman & terpercaya
                    </div>
                </div>
            </div>
        </div>

        {{-- ── OVERLAY ─────────────────────────────────────────────── --}}
        <div class="panel-overlay" id="panelOverlay" onclick="closeDetailPanel()"></div>

        {{-- ── DETAIL PANEL ────────────────────────────────────────── --}}
        <div class="detail-panel" id="detailPanel">
            <div class="panel-head">
                <h3>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--pk)"
                        stroke-width="2.5">
                        <circle cx="12" cy="12" r="10" />
                        <path d="M12 8v4l3 3" />
                    </svg>
                    Detail Pesanan
                </h3>
                <button class="panel-close" onclick="closeDetailPanel()">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5">
                        <path d="M18 6L6 18M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="panel-body">

                {{-- ── 1. ALAMAT PENGIRIMAN ─────────────────────────── --}}
                <div id="section-alamat">
                    <p class="panel-section-title">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="var(--pk)" stroke="none">
                            <path
                                d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5s2.5 1.12 2.5 2.5S13.38 11.5 12 11.5z" />
                        </svg>
                        Alamat Pengiriman
                    </p>
                    <div class="field-group">
                        <div>
                            <label class="field-label">Nama Penerima</label>
                            <input type="text" class="field-input" id="f-nama"
                                placeholder="Nama lengkap penerima">
                        </div>
                        <div>
                            <label class="field-label">Nomor Telepon</label>
                            <input type="tel" class="field-input" id="f-telp" placeholder="08xxxxxxxxxx">
                        </div>
                        <div class="field-row">
                            <div>
                                <label class="field-label">Provinsi</label>
                                <select class="field-select" id="f-provinsi">
                                    <option value="">Pilih Provinsi</option>
                                    <option>Jawa Barat</option>
                                    <option>Jawa Tengah</option>
                                    <option>Jawa Timur</option>
                                    <option>DKI Jakarta</option>
                                    <option>DI Yogyakarta</option>
                                    <option>Banten</option>
                                    <option>Bali</option>
                                    <option>Sumatera Utara</option>
                                    <option>Sumatera Selatan</option>
                                    <option>Kalimantan Timur</option>
                                </select>
                            </div>
                            <div>
                                <label class="field-label">Kota / Kabupaten</label>
                                <input type="text" class="field-input" id="f-kota" placeholder="Nama kota">
                            </div>
                        </div>
                        <div class="field-row">
                            <div>
                                <label class="field-label">Kecamatan</label>
                                <input type="text" class="field-input" id="f-kec" placeholder="Kecamatan">
                            </div>
                            <div>
                                <label class="field-label">Kode Pos</label>
                                <input type="text" class="field-input" id="f-kodepos" placeholder="12345"
                                    maxlength="5">
                            </div>
                        </div>
                        <div>
                            <label class="field-label">Alamat Lengkap</label>
                            <textarea class="field-input" id="f-alamat" rows="3" placeholder="Jl. Nama Jalan No. xx, RT/RW, Kelurahan..."
                                style="resize:vertical; line-height:1.5;"></textarea>
                        </div>
                        <div>
                            <label class="field-label">Catatan untuk Kurir <span
                                    style="color:var(--gray); font-weight:400;">(opsional)</span></label>
                            <input type="text" class="field-input" id="f-catatan"
                                placeholder="Contoh: titip di depan pagar">
                        </div>
                    </div>
                </div>

                {{-- ── 2. METODE PEMBAYARAN ─────────────────────────── --}}
                <div id="section-payment">
                    <p class="panel-section-title">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--pk)"
                            stroke-width="2.5">
                            <rect x="2" y="5" width="20" height="14" rx="3" />
                            <path d="M2 10h20" />
                        </svg>
                        Metode Pembayaran
                    </p>
                    <div class="payment-options">

                        <label class="payment-option selected" onclick="selectPayment(this, 'qris')">
                            <input type="radio" name="payment" value="qris" checked>
                            <div class="payment-icon-box" style="background:#FFF3E0; color:#E65100;">QRIS</div>
                            <div>
                                <div class="payment-option-label">QRIS</div>
                                <div class="payment-option-sub">Scan & bayar</div>
                            </div>
                        </label>

                        <label class="payment-option" onclick="selectPayment(this, 'transfer')">
                            <input type="radio" name="payment" value="transfer">
                            <div class="payment-icon-box" style="background:#E3F2FD; color:#0D47A1;">TF</div>
                            <div>
                                <div class="payment-option-label">Transfer Bank</div>
                                <div class="payment-option-sub">BCA / BNI / BRI</div>
                            </div>
                        </label>

                        <label class="payment-option" onclick="selectPayment(this, 'va')">
                            <input type="radio" name="payment" value="va">
                            <div class="payment-icon-box" style="background:#E8F5E9; color:#1B5E20;">VA</div>
                            <div>
                                <div class="payment-option-label">Virtual Account</div>
                                <div class="payment-option-sub">Auto konfirmasi</div>
                            </div>
                        </label>

                        <label class="payment-option" onclick="selectPayment(this, 'cod')">
                            <input type="radio" name="payment" value="cod">
                            <div class="payment-icon-box" style="background:#FCE4EC; color:#880E4F;">COD</div>
                            <div>
                                <div class="payment-option-label">Bayar di Tempat</div>
                                <div class="payment-option-sub">Cash on Delivery</div>
                            </div>
                        </label>

                        <label class="payment-option" onclick="selectPayment(this, 'ewallet')">
                            <input type="radio" name="payment" value="ewallet">
                            <div class="payment-icon-box" style="background:#F3E5F5; color:#4A148C;">EW</div>
                            <div>
                                <div class="payment-option-label">E-Wallet</div>
                                <div class="payment-option-sub">GoPay / OVO / Dana</div>
                            </div>
                        </label>

                        <label class="payment-option" onclick="selectPayment(this, 'paylater')">
                            <input type="radio" name="payment" value="paylater">
                            <div class="payment-icon-box" style="background:#FFF8E1; color:#F57F17;">PL</div>
                            <div>
                                <div class="payment-option-label">Pay Later</div>
                                <div class="payment-option-sub">Kredivo / Akulaku</div>
                            </div>
                        </label>

                    </div>
                </div>

                {{-- ── 3. WAKTU PENGIRIMAN ──────────────────────────── --}}
                <div id="section-pengiriman">
                    <p class="panel-section-title">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--pk)"
                            stroke-width="2.5">
                            <path d="M5 17H3a2 2 0 01-2-2V5a2 2 0 012-2h11a2 2 0 012 2v3M13 17h8l-3-6H13V7" />
                            <circle cx="7.5" cy="18.5" r="1.5" />
                            <circle cx="17.5" cy="18.5" r="1.5" />
                        </svg>
                        Waktu Pengiriman
                    </p>
                    <div class="shipping-options">

                        <label class="shipping-option" onclick="selectShipping(this, 'fast', 25000)">
                            <input type="radio" name="shipping" value="fast">
                            <div class="shipping-icon" style="background:#FFF3E0;">⚡</div>
                            <div class="ship-info">
                                <div class="ship-name">Fast Delivery</div>
                                <div class="ship-duration">Estimasi 1–2 hari kerja</div>
                                <span class="ship-badge" style="background:#FFF3E0; color:#E65100;">Tercepat</span>
                            </div>
                            <div>
                                <div class="ship-price">Rp 25.000</div>
                            </div>
                        </label>

                        <label class="shipping-option selected" onclick="selectShipping(this, 'medium', 15000)">
                            <input type="radio" name="shipping" value="medium" checked>
                            <div class="shipping-icon" style="background:#E8F5E9;">🚚</div>
                            <div class="ship-info">
                                <div class="ship-name">Medium Delivery</div>
                                <div class="ship-duration">Estimasi 3–5 hari kerja</div>
                                <span class="ship-badge" style="background:#E8F5E9; color:#2E7D32;">Populer</span>
                            </div>
                            <div>
                                <div class="ship-price">Rp 15.000</div>
                            </div>
                        </label>

                        <label class="shipping-option" onclick="selectShipping(this, 'slow', 8000)">
                            <input type="radio" name="shipping" value="slow">
                            <div class="shipping-icon" style="background:#E3F2FD;">📦</div>
                            <div class="ship-info">
                                <div class="ship-name">Slow Delivery</div>
                                <div class="ship-duration">Estimasi 5–7 hari kerja</div>
                                <span class="ship-badge" style="background:#E3F2FD; color:#0D47A1;">Hemat</span>
                            </div>
                            <div>
                                <div class="ship-price">Rp 8.000</div>
                            </div>
                        </label>

                    </div>
                </div>

            </div>{{-- end panel-body --}}

            <div class="panel-footer">
                <button class="btn-save-detail" onclick="saveDetailPesanan()">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5">
                        <path d="M20 6L9 17l-5-5" />
                    </svg>
                    Simpan Detail Pesanan
                </button>
            </div>
        </div>
    </div>

    <script src="{{asset('storage/js/payment.js')}}"></script>
</body>
</html>
