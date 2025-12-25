<x-app-layout>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@800&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f1f5f9; }
        * { border-radius: 0 !important; }

        .compact-card {
            background: #ffffff;
            border: 2px solid #000;
            box-shadow: 4px 4px 0px 0px #000;
            display: flex;
            flex-direction: column;
        }

        .status-header {
            background: #000;
            color: #fff;
            padding: 6px 12px;
            font-size: 0.7rem;
            font-weight: 900;
        }

        .item-row {
            border-bottom: 1px dashed #000;
            padding: 8px 0;
        }

        .item-row:last-child { border-bottom: none; }

        .btn-done {
            background: #22c55e;
            color: #000;
            border: 2px solid #000;
            font-weight: 900;
            padding: 10px;
            width: 100%;
            text-transform: uppercase;
            font-size: 0.8rem;
            transition: 0.2s;
        }

        .btn-done:hover { background: #000; color: #fff; }

        .banner-black {
            background: #000;
            color: #fff;
            padding: 15px;
            border: 2px solid #000;
            margin-bottom: 20px;
        }
    </style>

    <x-slot name="head">
        <meta http-equiv="refresh" content="15">
    </x-slot>

    <div class="py-6 px-4">
        <div class="max-w-7xl mx-auto">
            
            <div class="flex justify-between items-center mb-6 border-b-2 border-black pb-4">
                <h2 class="text-2xl font-black tracking-tighter uppercase text-black">ORDER MONITOR</h2>
                <div class="flex gap-2">
                    <button onclick="location.reload()" class="border-2 border-black px-3 py-1 bg-white font-black text-[10px] uppercase">REFRESH</button>
                    <form action="{{ route('kasir.clear-all') }}" method="POST" onsubmit="return confirm('Hapus semua antrian?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="border-2 border-black px-3 py-1 bg-red-600 text-white font-black text-[10px] uppercase">CLEAR ALL</button>
                    </form>
                </div>
            </div>

            <div class="banner-black flex justify-around items-center shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                <div class="text-center">
                    <p class="text-[9px] text-green-500 font-black uppercase mb-1">Revenue</p>
                    <p class="text-2xl font-black italic text-white">Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}</p>
                </div>
                <div class="h-8 w-[2px] bg-white/20"></div>
                <div class="text-center">
                    <p class="text-[9px] text-green-500 font-black uppercase mb-1">Orders</p>
                    <p class="text-2xl font-black text-white">{{ $orders->count() }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($orders as $o)
                <div class="compact-card">
                    <div class="status-header flex justify-between uppercase italic">
                        <span>#MEJA {{ $o->nomor_meja }}</span>
                        <span>{{ $o->created_at->format('H:i') }}</span>
                    </div>
                    
                    <div class="p-4 border-b-2 border-black bg-white">
                        <h3 class="text-lg font-black uppercase text-black">{{ $o->nama_pemesan }}</h3>
                    </div>

                    <div class="p-4 flex-grow bg-slate-50">
                        <div class="space-y-1">
                            @foreach($o->items as $item)
                            <div class="item-row flex justify-between items-center">
                                <span class="font-black text-[13px] uppercase text-black">
                                    {{ $item->menu->nama ?? 'N/A' }} 
                                    <span class="text-green-600 ml-1">({{ $item->qty }}x)</span>
                                </span>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="p-4 border-t-2 border-black bg-white">
                        <div class="flex justify-between items-center mb-4">
                            <p class="text-[10px] font-black text-slate-500 uppercase">BILL TOTAL</p>
                            <p class="text-xl font-black tracking-tighter text-black">Rp {{ number_format($o->total, 0, ',', '.') }}</p>
                        </div>
                        
                        <form action="{{ route('kasir.order.destroy', $o->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-done">SELESAI</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>

            @if($orders->isEmpty())
                <div class="text-center py-20 border-4 border-dashed border-black bg-white">
                    <p class="font-black text-black uppercase italic text-sm">-- TIDAK ADA ANTRIAN --</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>