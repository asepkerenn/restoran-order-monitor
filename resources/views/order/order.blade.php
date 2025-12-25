<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Digital | Restoran Sejalan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .menu-card { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .menu-card:hover { transform: translateY(-4px); }
        /* Menghilangkan spin button pada input number */
        input::-webkit-outer-spin-button, input::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }
    </style>
</head>
<body class="bg-slate-50 pb-32">

    <header class="bg-white/80 backdrop-blur-md shadow-sm sticky top-0 z-30 border-b border-slate-100">
        <div class="max-w-2xl mx-auto px-6 py-4 flex justify-between items-center">
            <div>
                <h1 class="text-xl font-extrabold text-slate-800 tracking-tighter">SEJALAN<span class="text-orange-500">.</span></h1>
            </div>
            <div class="flex items-center gap-2 bg-orange-50 px-3 py-1 rounded-full">
                <div class="w-2 h-2 bg-orange-500 rounded-full animate-pulse"></div>
                <span class="text-[10px] font-bold text-orange-600 uppercase tracking-widest">Dapur Buka</span>
            </div>
        </div>
    </header>

    <main class="max-w-2xl mx-auto px-6 mt-8">
        
        <div class="mb-10">
            <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Mau makan apa <br>hari ini?</h2>
            <p class="text-slate-500 mt-2 font-medium">Silakan pilih menu favorit Anda di bawah.</p>
        </div>

        @if(session('error'))
            <div class="bg-red-50 border-2 border-red-100 text-red-600 p-4 mb-8 rounded-2xl flex items-center gap-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="font-bold text-sm">{{ session('error') }}</span>
            </div>
        @endif

        <form method="POST" action="/order" onsubmit="return cekTotal()">
            @csrf

            <div class="bg-slate-900 p-6 rounded-[2.5rem] shadow-xl mb-10 text-white">
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2 ml-1">Nama Lengkap</label>
                        <input type="text" name="nama" placeholder="Siapa nama Anda?" required
                            class="w-full bg-white/10 border-none focus:ring-2 focus:ring-orange-500 rounded-2xl py-4 px-6 text-white font-bold placeholder:text-slate-500 transition">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2 ml-1">Nomor Meja</label>
                        <input type="number" name="meja" placeholder="00" required
                            class="w-full bg-white/10 border-none focus:ring-2 focus:ring-orange-500 rounded-2xl py-4 px-6 text-white font-bold placeholder:text-slate-500 transition">
                    </div>
                </div>
            </div>

            <div class="space-y-4">
                <h3 class="text-sm font-black text-slate-400 uppercase tracking-[0.3em] mb-6 ml-2">Pilihan Menu</h3>
                
                @foreach($menus as $i => $m)
                <div class="menu-card bg-white p-2 rounded-[2rem] shadow-sm border border-slate-100 flex items-center justify-between group">
                    <div class="flex items-center gap-4 flex-1">
                        <div class="w-20 h-20 bg-slate-50 rounded-[1.5rem] flex items-center justify-center text-2xl group-hover:bg-orange-50 transition-colors">
                            🍱
                        </div>
                        <div class="flex-1">
                            <h3 class="font-extrabold text-slate-800 text-base capitalize leading-tight">{{ $m->nama }}</h3>
                            <p class="text-orange-600 font-bold text-sm mt-1">Rp {{ number_format($m->harga, 0, ',', '.') }}</p>
                            <input type="hidden" class="harga" value="{{ $m->harga }}">
                            <input type="hidden" name="menu_id[]" value="{{ $m->id }}">
                        </div>
                    </div>
                    
                    <div class="flex items-center bg-slate-50 p-1.5 rounded-2xl mr-2">
                        <button type="button" onclick="ubahQty(this, -1)" 
                            class="w-10 h-10 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-slate-600 hover:text-red-500 transition-all active:scale-90 font-bold">-</button>
                        
                        <input type="number" name="qty[]" value="0" min="0" readonly
                            class="w-12 text-center border-none font-black text-slate-800 bg-transparent focus:ring-0 text-lg">
                        
                        <button type="button" onclick="ubahQty(this, 1)" 
                            class="w-10 h-10 rounded-xl bg-orange-500 flex items-center justify-center text-white hover:bg-orange-600 transition-all shadow-lg shadow-orange-200 active:scale-90 font-bold">+</button>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="fixed bottom-6 left-6 right-6 z-40">
                <div class="max-w-md mx-auto bg-slate-900/90 backdrop-blur-xl rounded-[2.5rem] p-4 shadow-2xl flex items-center justify-between border border-white/10">
                    <div class="pl-4">
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Total Belanja</p>
                        <p class="text-xl font-black text-white leading-tight">Rp <span id="total">0</span></p>
                    </div>
                    <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-black py-4 px-8 rounded-full transition shadow-lg shadow-orange-900/20 transform active:scale-95 flex items-center gap-2">
                        PESAN
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </div>
            </div>

        </form>
    </main>

    <script>
        function ubahQty(btn, delta) {
            let input = btn.parentNode.querySelector('input[name="qty[]"]');
            let newVal = parseInt(input.value) + delta;
            if (newVal >= 0) {
                input.value = newVal;
                hitung();
            }
        }

        function hitung() {
            let harga = document.querySelectorAll('.harga');
            let qty = document.querySelectorAll('input[name="qty[]"]');
            let total = 0;

            for (let i = 0; i < qty.length; i++) {
                total += parseInt(harga[i].value) * parseInt(qty[i].value);
            }

            document.getElementById('total').innerText = total.toLocaleString('id-ID');
        }

        function cekTotal() {
            let total = parseInt(document.getElementById('total').innerText.replace(/\./g,''));
            if (total === 0) {
                alert('Pilih minimal 1 menu dulu ya!');
                return false;
            }
            return true;
        }
    </script>
</body>
</html>