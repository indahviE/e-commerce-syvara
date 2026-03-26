{{-- @extends('layouts.app') --}}

{{-- @section('title', 'Riwayat Pesanan - Syvara') --}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang - Syvara</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
<style>
/* ── Root ─────────────────────────────────────────────────── */
:root {
    --pk:        #F0157A;
    --pk-light:  #FFE8F3;
    --pk-soft:   #FFF5FA;
    --pk-mid:    #FC4DA0;
    --gray:      #6B7280;
    --dark:      #1F2937;
    --border-c:  #F3E6ED;
    --wh:        #FFFFFF;
}

/* ── Page ─────────────────────────────────────────────────── */
.orders-page {
    background: #FFF8FC;
    min-height: 100vh;
    padding: 40px 0 80px;
    font-family: 'Plus Jakarta Sans', sans-serif;
}

.page-wrap {
    max-width: 1000px;
    margin: 0 auto;
    padding: 0 20px;
}

/* ── Hero ─────────────────────────────────────────────────── */
.orders-hero {
    background: linear-gradient(135deg, var(--pk) 0%, #FF6DB6 65%, #FFB3D9 100%);
    border-radius: 24px;
    padding: 36px 40px;
    margin-bottom: 32px;
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
}

.orders-hero::before {
    content: '';
    position: absolute;
    top: -50px; right: -50px;
    width: 220px; height: 220px;
    background: rgba(255,255,255,.08);
    border-radius: 50%;
}

.orders-hero::after {
    content: '';
    position: absolute;
    bottom: -60px; right: 120px;
    width: 160px; height: 160px;
    background: rgba(255,255,255,.05);
    border-radius: 50%;
}

.hero-text h1 {
    font-family: 'Playfair Display', serif;
    font-size: 2rem;
    font-weight: 700;
    color: #fff;
    margin: 0 0 6px;
}

.hero-text p {
    color: rgba(255,255,255,.85);
    font-size: 0.9rem;
    margin: 0;
}

.hero-stats {
    display: flex;
    gap: 12px;
    z-index: 1;
}

.hero-stat {
    background: rgba(255,255,255,.18);
    backdrop-filter: blur(8px);
    border-radius: 14px;
    padding: 12px 18px;
    text-align: center;
    min-width: 80px;
}

.hero-stat-num {
    font-size: 1.5rem;
    font-weight: 700;
    color: #fff;
    line-height: 1;
}

.hero-stat-label {
    font-size: 0.7rem;
    color: rgba(255,255,255,.8);
    margin-top: 4px;
}

/* ── Filter Tabs ──────────────────────────────────────────── */
.filter-row {
    display: flex;
    gap: 8px;
    margin-bottom: 24px;
    overflow-x: auto;
    padding-bottom: 4px;
    scrollbar-width: none;
}

.filter-row::-webkit-scrollbar { display: none; }

.filter-tab {
    padding: 8px 18px;
    border-radius: 30px;
    border: 1.5px solid var(--border-c);
    background: var(--wh);
    font-size: 0.82rem;
    font-weight: 600;
    color: var(--gray);
    cursor: pointer;
    white-space: nowrap;
    transition: all .18s;
    font-family: inherit;
}

.filter-tab:hover { border-color: var(--pk); color: var(--pk); }
.filter-tab.active { background: var(--pk); border-color: var(--pk); color: #fff; }

/* ── Order Card ───────────────────────────────────────────── */
.order-card {
    background: var(--wh);
    border-radius: 20px;
    border: 1.5px solid var(--border-c);
    margin-bottom: 20px;
    overflow: hidden;
    box-shadow: 0 2px 16px rgba(240,21,122,0.05);
    transition: box-shadow .22s, transform .22s;
    animation: slideUp .35s ease both;
}

.order-card:hover {
    box-shadow: 0 8px 32px rgba(240,21,122,0.1);
    transform: translateY(-2px);
}

@keyframes slideUp {
    from { opacity: 0; transform: translateY(16px); }
    to   { opacity: 1; transform: translateY(0); }
}

.order-card:nth-child(1) { animation-delay: .05s; }
.order-card:nth-child(2) { animation-delay: .10s; }
.order-card:nth-child(3) { animation-delay: .15s; }
.order-card:nth-child(4) { animation-delay: .20s; }

/* ── Card Header ──────────────────────────────────────────── */
.order-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 16px 24px;
    border-bottom: 1px solid var(--pk-soft);
    gap: 12px;
    flex-wrap: wrap;
}

.order-head-left {
    display: flex;
    align-items: center;
    gap: 12px;
}

.order-no {
    font-size: 0.82rem;
    font-weight: 700;
    color: var(--pk);
    background: var(--pk-light);
    padding: 4px 12px;
    border-radius: 20px;
}

.order-date {
    font-size: 0.8rem;
    color: var(--gray);
    display: flex;
    align-items: center;
    gap: 4px;
}

.order-date svg { width: 12px; height: 12px; }

/* ── Status Badge ─────────────────────────────────────────── */
.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 0.78rem;
    font-weight: 700;
    padding: 6px 14px;
    border-radius: 20px;
    letter-spacing: .02em;
}

.status-badge .dot-pulse {
    width: 7px; height: 7px;
    border-radius: 50%;
    flex-shrink: 0;
}

/* Statuses */
.status-selesai    { background: #ECFDF5; color: #065F46; }
.status-selesai .dot-pulse    { background: #10B981; }

.status-diantar    { background: #EFF6FF; color: #1E40AF; }
.status-diantar .dot-pulse    { background: #3B82F6; animation: pulse 1.5s infinite; }

.status-menunggu   { background: #FFFBEB; color: #92400E; }
.status-menunggu .dot-pulse   { background: #F59E0B; animation: pulse 1.5s infinite; }

.status-dibatalkan { background: #FEF2F2; color: #991B1B; }
.status-dibatalkan .dot-pulse { background: #EF4444; }

@keyframes pulse {
    0%, 100% { opacity: 1; transform: scale(1); }
    50%       { opacity: .5; transform: scale(1.3); }
}

/* ── Progress Steps ───────────────────────────────────────── */
.order-progress {
    padding: 16px 24px 0;
    display: flex;
    align-items: center;
    gap: 0;
}

.step {
    display: flex;
    flex-direction: column;
    align-items: center;
    flex: 1;
    position: relative;
}

.step-circle {
    width: 30px; height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.7rem;
    font-weight: 700;
    border: 2px solid #E5E7EB;
    background: #F9FAFB;
    color: #9CA3AF;
    z-index: 1;
    transition: all .3s;
}

.step-circle.done    { background: var(--pk); border-color: var(--pk); color: #fff; }
.step-circle.current { background: var(--wh); border-color: var(--pk); color: var(--pk); box-shadow: 0 0 0 4px rgba(240,21,122,.12); }

.step-label {
    font-size: 0.65rem;
    color: var(--gray);
    margin-top: 6px;
    text-align: center;
    line-height: 1.3;
    white-space: nowrap;
}

.step-label.done    { color: var(--pk); font-weight: 600; }
.step-label.current { color: var(--dark); font-weight: 700; }

.step-line {
    flex: 1;
    height: 2px;
    background: #E5E7EB;
    margin-top: -16px;
    transition: background .3s;
}
.step-line.done { background: var(--pk); }

/* ── Products List ────────────────────────────────────────── */
.order-products {
    padding: 20px 24px 0;
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.product-row {
    display: grid;
    grid-template-columns: 64px 1fr auto;
    gap: 14px;
    align-items: center;
}

.product-img {
    width: 64px; height: 64px;
    border-radius: 12px;
    object-fit: cover;
    border: 1.5px solid var(--border-c);
    background: var(--pk-light);
}

.product-img-placeholder {
    width: 64px; height: 64px;
    border-radius: 12px;
    background: var(--pk-light);
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1.5px solid var(--border-c);
    color: var(--pk);
}

.product-info-name {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--dark);
    line-height: 1.3;
}

.product-info-meta {
    font-size: 0.77rem;
    color: var(--gray);
    margin-top: 3px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.product-qty-badge {
    background: var(--pk-soft);
    color: var(--pk);
    font-size: 0.7rem;
    font-weight: 700;
    padding: 2px 8px;
    border-radius: 20px;
}

.product-price {
    font-size: 0.9rem;
    font-weight: 700;
    color: var(--dark);
    white-space: nowrap;
}

/* More products */
.more-products-btn {
    margin: 10px 24px 0;
    padding: 8px 14px;
    background: var(--pk-soft);
    border: 1px dashed var(--border-c);
    border-radius: 10px;
    font-size: 0.78rem;
    color: var(--gray);
    cursor: pointer;
    text-align: center;
    font-family: inherit;
    font-weight: 600;
    transition: all .18s;
    width: calc(100% - 48px);
}
.more-products-btn:hover { color: var(--pk); border-color: var(--pk); background: var(--pk-light); }

/* ── Card Footer ──────────────────────────────────────────── */
.order-foot {
    margin-top: 20px;
    padding: 16px 24px;
    background: var(--pk-soft);
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
    border-top: 1px solid var(--border-c);
}

.foot-info { display: flex; flex-direction: column; gap: 6px; }

.foot-row {
    display: flex;
    align-items: center;
    gap: 16px;
    font-size: 0.8rem;
    color: var(--gray);
    flex-wrap: wrap;
}

.foot-row-item {
    display: flex;
    align-items: center;
    gap: 5px;
}

.foot-row-item svg { width: 13px; height: 13px; flex-shrink: 0; }

.foot-total-label { font-size: 0.8rem; color: var(--gray); margin-bottom: 2px; }
.foot-total-price {
    font-size: 1.15rem;
    font-weight: 700;
    color: var(--pk);
}

.foot-actions { display: flex; gap: 8px; align-items: center; }

/* Action Buttons */
.btn-sm {
    padding: 9px 16px;
    border-radius: 10px;
    font-size: 0.8rem;
    font-weight: 700;
    cursor: pointer;
    font-family: inherit;
    transition: all .18s;
    display: flex;
    align-items: center;
    gap: 5px;
    white-space: nowrap;
    border: none;
    text-decoration: none;
}

.btn-sm svg { width: 14px; height: 14px; }

.btn-primary-sm {
    background: var(--pk);
    color: #fff;
    box-shadow: 0 4px 12px rgba(240,21,122,.25);
}
.btn-primary-sm:hover { opacity: .88; transform: translateY(-1px); }

.btn-outline-sm {
    background: var(--wh);
    color: var(--pk);
    border: 1.5px solid var(--pk) !important;
}
.btn-outline-sm:hover { background: var(--pk-light); }

.btn-ghost-sm {
    background: transparent;
    color: var(--gray);
    border: 1.5px solid #E5E7EB !important;
}
.btn-ghost-sm:hover { color: var(--dark); border-color: #9CA3AF !important; }

/* ── Detail Modal ─────────────────────────────────────────── */
.modal-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,.4);
    z-index: 9000;
    align-items: flex-start;
    justify-content: flex-end;
    padding: 20px;
}
.modal-overlay.open { display: flex; }

.modal-drawer {
    background: var(--wh);
    border-radius: 20px;
    width: 480px;
    max-width: 95vw;
    max-height: calc(100vh - 40px);
    overflow-y: auto;
    box-shadow: 0 20px 60px rgba(0,0,0,.15);
    animation: drawerIn .3s cubic-bezier(.4,0,.2,1);
}

@keyframes drawerIn {
    from { opacity: 0; transform: translateX(30px); }
    to   { opacity: 1; transform: translateX(0); }
}

.modal-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 20px 24px;
    border-bottom: 1.5px solid var(--border-c);
    position: sticky;
    top: 0;
    background: var(--wh);
    z-index: 2;
}

.modal-head h3 {
    font-size: 1rem;
    font-weight: 700;
    color: var(--dark);
    margin: 0;
}

.modal-close-btn {
    width: 32px; height: 32px;
    border-radius: 8px;
    border: 1.5px solid var(--border-c);
    background: transparent;
    cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    color: var(--gray);
    transition: all .18s;
}
.modal-close-btn:hover { background: #FEF2F2; color: #EF4444; }

.modal-body { padding: 24px; }

.modal-section { margin-bottom: 24px; }

.modal-section-title {
    font-size: 0.72rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .08em;
    color: var(--pk);
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 8px;
}
.modal-section-title::after {
    content: '';
    flex: 1;
    height: 1px;
    background: var(--border-c);
}

.modal-kv-table { width: 100%; border-collapse: collapse; }
.modal-kv-table td {
    padding: 7px 0;
    font-size: 0.85rem;
    vertical-align: top;
    border-bottom: 1px solid var(--pk-soft);
}
.modal-kv-table td:first-child {
    color: var(--gray);
    width: 45%;
    padding-right: 12px;
}
.modal-kv-table td:last-child {
    color: var(--dark);
    font-weight: 600;
    text-align: right;
}
.modal-kv-table tr:last-child td { border-bottom: none; }

.modal-product-row {
    display: grid;
    grid-template-columns: 52px 1fr auto;
    gap: 12px;
    align-items: center;
    padding: 10px 0;
    border-bottom: 1px solid var(--pk-soft);
}
.modal-product-row:last-child { border-bottom: none; }

.modal-prod-img {
    width: 52px; height: 52px;
    border-radius: 10px;
    object-fit: cover;
    background: var(--pk-light);
    border: 1px solid var(--border-c);
}

.modal-prod-name { font-size: 0.83rem; font-weight: 600; color: var(--dark); }
.modal-prod-meta { font-size: 0.75rem; color: var(--gray); margin-top: 2px; }
.modal-prod-price { font-size: 0.85rem; font-weight: 700; color: var(--dark); white-space: nowrap; }

.modal-total-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 0;
    border-top: 1.5px solid var(--border-c);
    margin-top: 4px;
}
.modal-total-row span:first-child { font-size: 0.875rem; font-weight: 700; color: var(--dark); }
.modal-total-row span:last-child  { font-size: 1.1rem; font-weight: 700; color: var(--pk); }

/* ── Timeline ─────────────────────────────────────────────── */
.timeline { position: relative; padding-left: 20px; }
.timeline::before {
    content: '';
    position: absolute;
    left: 6px; top: 8px; bottom: 8px;
    width: 2px;
    background: var(--border-c);
}

.tl-item {
    position: relative;
    padding: 0 0 16px 20px;
}
.tl-item:last-child { padding-bottom: 0; }

.tl-dot {
    position: absolute;
    left: -8px; top: 4px;
    width: 14px; height: 14px;
    border-radius: 50%;
    background: #E5E7EB;
    border: 2px solid var(--wh);
}
.tl-dot.done    { background: var(--pk); }
.tl-dot.current { background: var(--pk); box-shadow: 0 0 0 4px rgba(240,21,122,.15); }

.tl-title { font-size: 0.83rem; font-weight: 700; color: var(--dark); }
.tl-desc  { font-size: 0.77rem; color: var(--gray); margin-top: 2px; line-height: 1.4; }
.tl-time  { font-size: 0.72rem; color: #9CA3AF; margin-top: 2px; }

/* ── Empty State ──────────────────────────────────────────── */
.empty-orders {
    text-align: center;
    padding: 80px 24px;
    background: var(--wh);
    border-radius: 20px;
    border: 1.5px solid var(--border-c);
}
.empty-icon { font-size: 4rem; margin-bottom: 16px; display: block; }
.empty-orders h3 { font-size: 1.1rem; font-weight: 700; color: var(--dark); margin: 0 0 8px; }
.empty-orders p  { font-size: 0.875rem; color: var(--gray); margin: 0 0 24px; }

.btn-shop-now {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 14px 28px;
    background: linear-gradient(135deg, var(--pk), var(--pk-mid));
    color: #fff;
    border: none;
    border-radius: 14px;
    font-size: 0.9rem;
    font-weight: 700;
    cursor: pointer;
    font-family: inherit;
    text-decoration: none;
    box-shadow: 0 6px 20px rgba(240,21,122,.28);
    transition: all .22s;
}
.btn-shop-now:hover { transform: translateY(-2px); }

@media (max-width: 600px) {
    .orders-hero { flex-direction: column; padding: 24px 20px; }
    .hero-stats { width: 100%; }
    .hero-stat  { flex: 1; }
    .order-foot { flex-direction: column; align-items: flex-start; }
    .foot-actions { width: 100%; }
    .foot-actions .btn-sm { flex: 1; justify-content: center; }
    .product-row { grid-template-columns: 56px 1fr auto; }
    .modal-drawer { max-height: 100vh; border-radius: 20px 20px 0 0; }
    .modal-overlay { padding: 0; align-items: flex-end; }
}
</style>

</head>

{{-- @section('content') --}}
<body>
    <x-navbar/>
    <div class="orders-page">
<div class="page-wrap">
      <section class="relative  pb-6">
        <div class="max-w-7xl mx-auto">
            <div class="bg-pink-500 rounded-3xl p-8 sm:p-12 shadow-xl">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                    <div>
                        <h1 class="text-4xl md:text-5xl font-bold mb-3 text-white flex items-center gap-3">
                          History Pembayaran 
                        </h1>
                        <p class="text-pink-100 text-lg">Semua transaksi anda tercatat disini.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- ── Filter Tabs ───────────────────────────────────────── --}}
    <div class="filter-row">
        @php
            $filterLabels = [
                ''          => 'Semua',
                'menunggu'  => 'Menunggu',
                'diantar'   => 'Diantar',
                'selesai'   => 'Selesai',
            ];
            $currentFilter = request('status', '');
        @endphp
        @foreach($filterLabels as $val => $label)
            <a href=""
               class="filter-tab {{ $currentFilter === $val ? 'active' : '' }}">
                {{ $label }}
            </a>
        @endforeach
    </div>

    {{-- ── Orders ────────────────────────────────────────────── --}}
    @if($orders && $orders->isEmpty())
        <div class="empty-orders">
            <span class="empty-icon">🛍️</span>
            <h3>Belum ada pesanan</h3>
            <p>Kamu belum pernah melakukan pembelian. Yuk mulai belanja skincare terbaik!</p>
            <a href="{{ route('productMember') }}" class="btn-shop-now">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
                Mulai Belanja
            </a>
        </div>
    @else
        @foreach($orders as $order)
        @php
            $statusMap = [
                'selesai'    => ['label' => 'Selesai',              'class' => 'status-selesai'],
                'diantar'    => ['label' => 'Sedang Diantar',       'class' => 'status-diantar'],
                'menunggu'   => ['label' => 'Menunggu Pengecekan',  'class' => 'status-menunggu'],
                'dibatalkan' => ['label' => 'Dibatalkan',           'class' => 'status-dibatalkan'],
            ];
            $st = $statusMap[$order->status] ?? ['label' => ucfirst($order->status), 'class' => 'status-menunggu'];

            // Progress steps: 0=menunggu, 1=diproses, 2=diantar, 3=selesai
            $stepsDone = match($order->status) {
                'menunggu'   => 0,
                'diproses'   => 1,
                'diantar'    => 2,
                'selesai'    => 3,
                default      => 0,
            };

            $steps = ['Pesanan Masuk','Diproses','Dikirim','Selesai'];
            $visibleProducts = $order->items->take(2);
            $remainingCount  = $order->items->count() - 2;
        @endphp

        <div class="order-card" data-order-id="{{ $order->id }}">

            {{-- Head --}}
            <div class="order-head">
                <div class="order-head-left">
                    <span class="order-no">#{{ $order->kode_pesanan ?? 'ORD-'.$order->id }}</span>
                    <span class="order-date">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        {{ \Carbon\Carbon::parse($order->created_at)->locale('id')->isoFormat('D MMMM YYYY, HH:mm') }}
                    </span>
                </div>
                <span class="status-badge {{ $st['class'] }}">
                    <span class="dot-pulse"></span>
                    {{ $st['label'] }}
                </span>
            </div>

            {{-- Progress Bar --}}
            @if($order->status !== 'dibatalkan')
            <div class="order-progress" style="padding: 18px 24px 4px;">
                @foreach($steps as $i => $step)
                    <div class="step">
                        <div class="step-circle {{ $i < $stepsDone ? 'done' : ($i === $stepsDone ? 'current' : '') }}">
                            @if($i < $stepsDone)
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M20 6L9 17l-5-5"/></svg>
                            @else
                                {{ $i + 1 }}
                            @endif
                        </div>
                        <div class="step-label {{ $i < $stepsDone ? 'done' : ($i === $stepsDone ? 'current' : '') }}">{{ $step }}</div>
                    </div>
                    @if($i < count($steps) - 1)
                        <div class="step-line {{ $i < $stepsDone ? 'done' : '' }}"></div>
                    @endif
                @endforeach
            </div>
            @endif

            {{-- Products --}}
            <div class="order-products">
                @foreach($visibleProducts as $item)
                <div class="product-row">
                    @if($item->product->gambar)
                        <img src="{{ asset('storage/' . $item->product->gambar) }}"
                             alt="{{ $item->product->nama }}"
                             class="product-img">
                    @else
                        <div class="product-img-placeholder">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="3"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                        </div>
                    @endif
                    <div>
                        <div class="product-info-name">{{ $item->product->nama }}</div>
                        <div class="product-info-meta">
                            @if($item->product->kategori)
                                <span>{{ $item->product->kategori->nama }}</span>
                                <span>·</span>
                            @endif
                            <span class="product-qty-badge">x{{ $item->jumlah }}</span>
                        </div>
                    </div>
                    <div class="product-price">
                        Rp {{ number_format($item->harga_satuan * $item->jumlah, 0, ',', '.') }}
                    </div>
                </div>
                @endforeach
            </div>

            @if($remainingCount > 0)
            <button class="more-products-btn" onclick="openOrderDetail({{ $order->id }})">
                + {{ $remainingCount }} produk lainnya — lihat semua
            </button>
            @endif

            {{-- Footer --}}
            <div class="order-foot">
                <div class="foot-info">
                    <div class="foot-row">
                        @if($order->metode_pembayaran)
                        <div class="foot-row-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="5" width="20" height="14" rx="3"/><path d="M2 10h20"/></svg>
                            {{ ucwords(str_replace('_', ' ', $order->metode_pembayaran)) }}
                        </div>
                        @endif
                        @if($order->metode_pengiriman)
                        <div class="foot-row-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 17H3a2 2 0 01-2-2V5a2 2 0 012-2h11a2 2 0 012 2v3M13 17h8l-3-6H13V7"/><circle cx="7.5" cy="18.5" r="1.5"/><circle cx="17.5" cy="18.5" r="1.5"/></svg>
                            {{ ucwords($order->metode_pengiriman) }}
                            @if($order->estimasi_pengiriman)
                                · {{ $order->estimasi_pengiriman }}
                            @endif
                        </div>
                        @endif
                        @if($order->no_resi)
                        <div class="foot-row-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10H7M21 6H3M21 14H3M21 18H7"/></svg>
                            Resi: {{ $order->no_resi }}
                        </div>
                        @endif
                    </div>
                    <div>
                        <div class="foot-total-label">Total Pembayaran</div>
                        <div class="foot-total-price">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</div>
                    </div>
                </div>

                <div class="foot-actions">
                    <button class="btn-sm btn-ghost-sm" onclick="openOrderDetail({{ $order->id }})">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
                        Detail
                    </button>

                    @if($order->status === 'selesai')
                        <button class="btn-sm btn-outline-sm"
                            onclick="window.location.href='{{ route('orders.reorder', $order->id) }}'">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M1 4v6h6M23 20v-6h-6"/><path d="M20.49 9A9 9 0 005.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 013.51 15"/></svg>
                            Beli Lagi
                        </button>
                        <button class="btn-sm btn-ghost-sm"
                            onclick="window.location.href='{{ route('orders.review', $order->id) }}'">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                            Beri Ulasan
                        </button>
                    @elseif($order->status === 'menunggu')
                        <button class="btn-sm btn-primary-sm"
                            onclick="window.location.href='{{ route('orders.pay', $order->id) }}'">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="2" y="5" width="20" height="14" rx="3"/><path d="M2 10h20"/></svg>
                            Bayar Sekarang
                        </button>
                        <button class="btn-sm btn-ghost-sm"
                            onclick="cancelOrder({{ $order->id }})">
                            Batalkan
                        </button>
                    @elseif($order->status === 'diantar')
                        <button class="btn-sm btn-primary-sm"
                            onclick="confirmReceived({{ $order->id }})">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6L9 17l-5-5"/></svg>
                            Konfirmasi Terima
                        </button>
                    @endif
                </div>
            </div>
        </div>
        @endforeach

        {{-- Pagination --}}
        <div style="margin-top: 28px;">
            {{-- {{ $orders->links() }} --}}
        </div>
    @endif

</div>
</div>

{{-- ── ORDER DETAIL MODAL ──────────────────────────────────── --}}
<div class="modal-overlay" id="orderDetailModal" onclick="handleOverlayClick(event)">
    <div class="modal-drawer" id="modalDrawer">
        <div class="modal-head">
            <h3 id="modal-order-no">Detail Pesanan</h3>
            <button class="modal-close-btn" onclick="closeOrderDetail()">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M18 6L6 18M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="modal-body" id="modalBody">
            <div style="text-align:center; padding: 40px 0; color: var(--gray);">
                <div style="font-size: 2rem; margin-bottom: 12px;">⏳</div>
                Memuat detail pesanan...
            </div>
        </div>
    </div>
</div>
</body>



@push('scripts')
<script>
// ── Modal ─────────────────────────────────────────────────────
function openOrderDetail(orderId) {
    document.getElementById('orderDetailModal').classList.add('open');
    document.body.style.overflow = 'hidden';

    fetch(`/orders/${orderId}/detail`, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(r => r.json())
    .then(data => renderModal(data))
    .catch(() => {
        document.getElementById('modalBody').innerHTML =
            '<p style="color:#EF4444; text-align:center; padding:40px 0;">Gagal memuat data.</p>';
    });
}

function closeOrderDetail() {
    document.getElementById('orderDetailModal').classList.remove('open');
    document.body.style.overflow = '';
}

function handleOverlayClick(e) {
    if (e.target === document.getElementById('orderDetailModal')) closeOrderDetail();
}

document.addEventListener('keydown', e => {
    if (e.key === 'Escape') closeOrderDetail();
});

function renderModal(d) {
    document.getElementById('modal-order-no').textContent = 'Pesanan #' + (d.kode_pesanan || d.id);

    const fmt = n => 'Rp ' + parseInt(n).toLocaleString('id-ID');

    // Status color
    const stColors = {
        selesai: '#065F46', diantar: '#1E40AF',
        menunggu: '#92400E', dibatalkan: '#991B1B'
    };
    const stBg = {
        selesai: '#ECFDF5', diantar: '#EFF6FF',
        menunggu: '#FFFBEB', dibatalkan: '#FEF2F2'
    };

    const statusLabel = {
        selesai: 'Selesai', diantar: 'Sedang Diantar',
        menunggu: 'Menunggu Pengecekan', dibatalkan: 'Dibatalkan'
    };

    // Products
    const prods = d.items.map(item => `
        <div class="modal-product-row">
            <img src="${item.gambar || ''}" alt="${item.nama}"
                 class="modal-prod-img"
                 onerror="this.style.background='#FFE8F3'; this.src=''">
            <div>
                <div class="modal-prod-name">${item.nama}</div>
                <div class="modal-prod-meta">${item.kategori ?? ''} · x${item.jumlah}</div>
                <div class="modal-prod-meta">${fmt(item.harga_satuan)} / pcs</div>
            </div>
            <div class="modal-prod-price">${fmt(item.harga_satuan * item.jumlah)}</div>
        </div>
    `).join('');

    // Timeline
    const tlSteps = [
        { title: 'Pesanan Diterima',   desc: 'Pesanan kamu berhasil masuk ke sistem', time: d.created_at,       done: true },
        { title: 'Pembayaran Terkonfirmasi', desc: 'Pembayaran sudah diverifikasi',  time: d.paid_at,           done: !!d.paid_at },
        { title: 'Pesanan Diproses',   desc: 'Produk sedang disiapkan',              time: d.processed_at,      done: !!d.processed_at },
        { title: 'Pesanan Dikirim',    desc: `Dalam perjalanan${d.no_resi ? ' · Resi: '+d.no_resi : ''}`, time: d.shipped_at, done: !!d.shipped_at },
        { title: 'Pesanan Diterima',   desc: 'Pesanan telah sampai di tujuan',       time: d.completed_at,      done: !!d.completed_at },
    ];

    const currentIdx = tlSteps.reduce((last, s, i) => s.done ? i : last, 0);

    const timeline = tlSteps.map((s, i) => `
        <div class="tl-item">
            <div class="tl-dot ${s.done ? (i === currentIdx ? 'current' : 'done') : ''}"></div>
            <div class="tl-title" style="color: ${s.done ? 'var(--dark)' : '#9CA3AF'}">${s.title}</div>
            <div class="tl-desc"  style="color: ${s.done ? 'var(--gray)' : '#D1D5DB'}">${s.desc}</div>
            ${s.time ? `<div class="tl-time">${s.time}</div>` : ''}
        </div>
    `).join('');

    document.getElementById('modalBody').innerHTML = `
        <div class="modal-section">
            <p class="modal-section-title">Status Pesanan</p>
            <div style="display:flex; align-items:center; gap:10px; margin-bottom:8px;">
                <span style="background:${stBg[d.status]||'#F3F4F6'}; color:${stColors[d.status]||'#374151'}; font-size:.82rem; font-weight:700; padding:6px 14px; border-radius:20px;">
                    ${statusLabel[d.status] || d.status}
                </span>
            </div>
            <div class="timeline">${timeline}</div>
        </div>

        <div class="modal-section">
            <p class="modal-section-title">Produk Dipesan</p>
            ${prods}
            <div class="modal-total-row">
                <span>Total Pembayaran</span>
                <span>${fmt(d.total_harga)}</span>
            </div>
        </div>

        <div class="modal-section">
            <p class="modal-section-title">Info Pembayaran</p>
            <table class="modal-kv-table">
                <tr><td>Metode Pembayaran</td><td>${d.metode_pembayaran?.replace(/_/g,' ') ?? '—'}</td></tr>
                <tr><td>Subtotal Produk</td>  <td>${fmt(d.subtotal ?? d.total_harga)}</td></tr>
                <tr><td>Ongkos Kirim</td>     <td>${fmt(d.ongkir ?? 0)}</td></tr>
                <tr><td>Biaya Layanan</td>    <td>${fmt(d.biaya_layanan ?? 0)}</td></tr>
                ${d.diskon > 0 ? `<tr><td>Diskon</td><td style="color:#EF4444">−${fmt(d.diskon)}</td></tr>` : ''}
                <tr><td style="font-weight:700;color:var(--dark)">Total</td>
                    <td style="color:var(--pk);font-size:1rem">${fmt(d.total_harga)}</td></tr>
            </table>
        </div>

        <div class="modal-section">
            <p class="modal-section-title">Pengiriman</p>
            <table class="modal-kv-table">
                <tr><td>Metode</td>   <td>${d.metode_pengiriman ?? '—'}</td></tr>
                <tr><td>Estimasi</td> <td>${d.estimasi_pengiriman ?? '—'}</td></tr>
                ${d.no_resi ? `<tr><td>No. Resi</td><td>${d.no_resi}</td></tr>` : ''}
                <tr><td>Penerima</td> <td>${d.nama_penerima ?? '—'}</td></tr>
                <tr><td>Telepon</td>  <td>${d.telepon ?? '—'}</td></tr>
                <tr><td>Alamat</td>   <td>${d.alamat_lengkap ?? '—'}</td></tr>
            </table>
        </div>
    `;
}

// ── Actions ───────────────────────────────────────────────────
function confirmReceived(id) {
    if (!confirm('Konfirmasi bahwa pesanan sudah kamu terima?')) return;
    fetch(`/orders/${id}/received`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json'
        }
    }).then(r => { if (r.ok) location.reload(); });
}

function cancelOrder(id) {
    if (!confirm('Yakin ingin membatalkan pesanan ini?')) return;
    fetch(`/orders/${id}/cancel`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json'
        }
    }).then(r => { if (r.ok) location.reload(); });
}
</script>
@endpush