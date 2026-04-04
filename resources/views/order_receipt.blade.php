<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pesanan #{{ $order->id }} - Syvara</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f8fafc;
        }

        .receipt-card {
            max-width: 900px;
            margin: 0 auto;
        }

        .receipt-card .tag {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
        }

        .receipt-card .tag span {
            display: inline-block;
            border-radius: 999px;
            padding: .45rem 1rem;
            background: rgba(236, 72, 153, 0.12);
            color: #be185d;
            font-weight: 600;
            font-size: .85rem;
        }

        .download-button {
            min-width: 180px;
        }

        @media print {
            .no-print {
                display: none !important;
            }
        }
    </style>
</head>

<body class="bg-pink-50">
    <x-navbar />

    <section class="py-12 px-4" >
        <div  id="receiptContent" class="receipt-card bg-white rounded-[32px] border border-pink-100 shadow-xl overflow-hidden">
            <div class="bg-gradient-to-r from-pink-500 to-rose-500 px-8 py-8 text-white">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <p class="text-sm uppercase tracking-[.2em] font-semibold">Struk Pembelian</p>
                        <h1 class="text-4xl font-bold mt-2">Pesanan #{{ $order->id }}</h1>
                    </div>
                    <div class="space-y-2 text-right">
                        <p class="text-sm opacity-90">Tanggal:</p>
                        <p class="text-xl font-semibold">
                            {{ $order->created_at->locale('id')->isoFormat('D MMMM YYYY HH:mm') }}</p>
                    </div>
                </div>
            </div>

            <div  class="p-8">
                <div class="grid gap-6 md:grid-cols-3 mb-8">
                    <div class="rounded-3xl border border-pink-100 bg-pink-50 p-6">
                        <p class="text-sm text-pink-600 font-semibold">Status</p>
                        <p class="mt-3 text-xl font-bold text-gray-900">{{ $order->status_order }}</p>
                        <span class="tag"><span>{{ $order->payment_method ?? 'Tidak diketahui' }}</span></span>
                    </div>
                    <div class="rounded-3xl border border-pink-100 bg-white p-6">
                        <p class="text-sm text-gray-500 uppercase tracking-[.2em]">Penerima</p>
                        <p class="mt-3 text-lg font-semibold text-gray-900">{{ $order->nama_penerima }}</p>
                        <p class="text-sm text-gray-600">{{ $order->no_telp }}</p>
                    </div>
                    <div class="rounded-3xl border border-pink-100 bg-white p-6">
                        <p class="text-sm text-gray-500 uppercase tracking-[.2em]">Alamat</p>
                        <p class="mt-3 text-sm text-gray-700 leading-relaxed">
                            {{ $order->alamat ?? '' }}<br>
                            {{ implode(', ', array_filter([$order->kecamatan, $order->kabupaten, $order->provinsi, $order->kode_pos])) }}
                        </p>
                    </div>
                </div>

                <div class="rounded-[32px] border border-pink-100 bg-gray-50 p-6">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <p class="text-xl font-bold text-gray-900">Rincian Produk</p>
                            <p class="text-sm text-gray-500">Detail daftar barang yang dibeli.</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-500">Total</p>
                            <p class="text-2xl font-semibold text-pink-600">Rp
                                {{ number_format($order->total_price, 0, ',', '.') }}</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        @foreach ($order->orderDetails as $item)
                            <div
                                class="grid gap-4 md:grid-cols-[auto_1fr_auto] items-center rounded-3xl border border-pink-100 bg-white p-5">
                                <div class="rounded-3xl bg-pink-50 w-20 h-20 flex items-center justify-center">
                                    @if ($item->product && $item->product->image)
                                        <img src="{{ asset('storage/' . $item->product->image) }}"
                                            alt="{{ $item->product->name }}"
                                            class="w-full h-full object-cover rounded-3xl">
                                    @else
                                        <i class="fas fa-box-open text-pink-500 text-2xl"></i>
                                    @endif
                                </div>
                                <div>
                                    <p class="text-lg font-semibold text-gray-900">
                                        {{ $item->product->name ?? 'Produk tidak tersedia' }}</p>
                                    <p class="text-sm text-gray-500">Kategori:
                                        {{ $item->product?->category_names ?? '-' }}</p>
                                    <p class="text-sm text-gray-500 mt-2">Qty: {{ $item->qty }} • Harga satuan: Rp
                                        {{ number_format($item->harga_saat_ini, 0, ',', '.') }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm text-gray-500">Subtotal</p>
                                    <p class="text-lg font-bold text-gray-900">Rp
                                        {{ number_format($item->subtotal_price, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mt-8 grid gap-4 md:grid-cols-2">
                    <div class="rounded-3xl border border-pink-100 bg-white p-6">
                        <p class="text-sm text-gray-500 uppercase tracking-[.2em]">Voucher</p>
                        <p class="mt-3 text-lg font-semibold text-gray-900">{{ $order->voucher?->kode ?? 'Tidak ada' }}
                        </p>
                        <p class="text-sm text-gray-600">Diskon:
                            {{ $order->voucher?->discount ? $order->voucher->discount . '%' : '-' }}</p>
                    </div>
                    <div class="rounded-3xl border border-pink-100 bg-white p-6">
                        <p class="text-sm text-gray-500 uppercase tracking-[.2em]">Catatan Kurir</p>
                        <p class="mt-3 text-lg text-gray-700">
                            {{ $order->catatan_kurir ?: 'Tidak ada catatan tambahan.' }}</p>
                    </div>
                </div>

                <div class="no-print mt-10 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <a href="{{ route('history') }}"
                        class="inline-flex items-center gap-2 rounded-full border border-pink-200 bg-white px-6 py-3 text-sm font-semibold text-gray-700 hover:bg-pink-50 transition">
                        <i class="fas fa-arrow-left"></i> Kembali ke History
                    </a>
                    <div class="flex flex-col gap-3 sm:flex-row">
                        <button id="downloadReceiptBtn"
                            class="download-button inline-flex items-center justify-center gap-2 rounded-full bg-pink-600 px-6 py-3 text-sm font-semibold text-white hover:bg-pink-700 transition">
                            <i class="fas fa-download"></i> Download Struk
                        </button>
                        <button id="printReceiptBtn"
                            class="inline-flex items-center justify-center gap-2 rounded-full bg-white border border-pink-200 px-6 py-3 text-sm font-semibold text-pink-600 hover:bg-pink-50 transition">
                            <i class="fas fa-print"></i> Cetak Struk
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script>
        document.getElementById('downloadReceiptBtn').addEventListener('click', function() {
            const elementsToHide = document.querySelectorAll('.no-print');
            elementsToHide.forEach(el => el.style.display = 'none');
            const receipt = document.getElementById('receiptContent');
            html2canvas(receipt, {
                scale: 2
            }).then(canvas => {
                const link = document.createElement('a');
                link.href = canvas.toDataURL('image/png');
                link.download = 'struk-pesanan-{{ $order->id }}.png';
                link.click();
                elementsToHide.forEach(el => el.style.display = '');
            });
        });

        document.getElementById('printReceiptBtn').addEventListener('click', function() {
            window.print();
        });
    </script>
</body>

</html>
