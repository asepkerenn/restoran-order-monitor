<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terima Kasih | Restoran Sejalan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">

    <div class="max-w-md w-full bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
        <div class="bg-green-500 p-8 text-center text-white">
            <div class="bg-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h1 class="text-2xl font-bold uppercase tracking-wide">Pesanan Diterima!</h1>
            <p class="text-green-100 opacity-90 text-sm">Pesanan Anda sedang kami siapkan</p>
        </div>

        <div class="p-8">
            <div class="flex justify-between items-center mb-6 pb-6 border-b border-dashed border-gray-200">
                <div>
                    <p class="text-[10px] text-gray-400 uppercase font-bold tracking-widest">Pelanggan</p>
                    <p class="text-lg font-semibold text-gray-800">{{ $order->nama_pemesan }}</p>
                </div>
                <div class="text-right">
                    <p class="text-[10px] text-gray-400 uppercase font-bold tracking-widest">No. Meja</p>
                    <p class="text-lg font-semibold text-gray-800">{{ $order->nomor_meja }}</p>
                </div>
            </div>

            <div class="bg-orange-50 rounded-2xl p-6 mb-8 text-center border border-orange-100">
                <p class="text-xs text-orange-400 uppercase font-bold mb-1">Total Pembayaran</p>
                <p class="text-3xl font-black text-orange-600">
                    Rp {{ number_format($order->total, 0, ',', '.') }}
                </p>
            </div>

            <div class="text-center mb-8">
                <p class="text-xs text-gray-400 mb-4 italic">Scan QR ini di Kasir untuk Pembayaran</p>
                <div class="inline-block p-3 bg-white border-4 border-gray-50 rounded-2xl shadow-sm">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=ORDER-{{ $order->id }}" alt="QR Pembayaran" />
                </div>
            </div>

            <a href="{{ url('/') }}" class="block text-center w-full py-4 bg-gray-900 hover:bg-black text-white font-bold rounded-2xl transition duration-200 shadow-lg">
                Kembali ke Beranda
            </a>
            
            <p class="text-center text-[10px] text-gray-400 mt-6 uppercase tracking-widest">
                &copy; 2025 Restoran Sejalan
            </p>
        </div>
    </div>

</body>
</html>