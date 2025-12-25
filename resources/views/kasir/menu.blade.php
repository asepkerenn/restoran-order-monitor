<x-app-layout>
    <style>
        .font-premium { font-family: 'Inter', sans-serif; }
        .table-fixed-layout { table-layout: fixed; width: 100%; border-collapse: separate; border-spacing: 0 12px; }
        .input-clean { border: none; background: transparent; width: 100%; font-weight: 800; padding: 12px; border-radius: 12px; transition: all 0.2s; }
        .input-clean:focus { background: #f8fafc; box-shadow: inset 0 0 0 2px #f97316; outline: none; }
        
        /* Animasi untuk Tombol Tambah */
        .btn-add {
            background: linear-gradient(135deg, #f97316 0%, #fb923c 100%);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .btn-add:hover {
            filter: brightness(1.1);
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(249, 115, 22, 0.4);
        }
    </style>

    <div class="py-12 bg-slate-100 min-h-screen font-premium">
        <div class="max-w-5xl mx-auto px-4">
            
            <div class="mb-10 flex items-center gap-4">
                <div class="h-12 w-2 bg-orange-500 rounded-full"></div>
                <h2 class="text-4xl font-black text-slate-800 uppercase tracking-tighter">
                    Manajemen <span class="text-orange-600">Menu</span>
                </h2>
            </div>

            <div class="bg-white rounded-[2.5rem] shadow-xl p-3 mb-12 border border-slate-200/60">
                <form method="POST" action="/menu" class="flex flex-col md:flex-row items-center gap-2">
                    @csrf
                    <div class="flex-[3] w-full">
                        <input name="nama" placeholder="Ketik Nama Menu Baru..." required
                            class="w-full bg-transparent border-none rounded-3xl py-5 px-8 text-lg font-bold placeholder:text-slate-300 focus:ring-0">
                    </div>
                    
                    <div class="hidden md:block w-[2px] h-10 bg-slate-100"></div>

                    <div class="flex-[1.5] w-full flex items-center px-4">
                        <span class="text-orange-500 font-black text-xl mr-2">Rp</span>
                        <input type="number" name="harga" placeholder="Harga" required
                            class="w-full bg-transparent border-none rounded-3xl py-5 text-lg font-black placeholder:text-slate-300 focus:ring-0">
                    </div>

                    <button type="submit" class="btn-add w-full md:w-auto h-16 px-10 text-white font-black rounded-[2rem] shadow-lg text-sm uppercase tracking-widest active:scale-95">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Simpan Menu
                    </button>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="table-fixed-layout">
                    <thead>
                        <tr class="text-slate-400 text-[11px] font-black uppercase tracking-[0.3em]">
                            <th class="px-6 py-2 text-left w-[45%]">Informasi Produk</th>
                            <th class="px-6 py-2 text-left w-[25%]">Harga Satuan</th>
                            <th class="px-6 py-2 text-center w-[30%]">Aksi Pengelola</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($menus as $menu)
                        <tr class="bg-white shadow-sm rounded-3xl group transition-all hover:shadow-md">
                            <td class="px-6 py-2 first:rounded-l-[2rem] border-y border-l border-slate-50">
                                <form id="update-{{ $menu->id }}" method="POST" action="/menu/{{ $menu->id }}">
                                    @csrf @method('PUT')
                                    <input name="nama" value="{{ $menu->nama }}" class="input-clean text-xl text-slate-800">
                                </form>
                            </td>
                            <td class="px-6 py-2 border-y border-slate-50">
                                <div class="flex items-center">
                                    <span class="text-orange-500 font-black mr-2 text-lg">Rp</span>
                                    <input form="update-{{ $menu->id }}" name="harga" value="{{ $menu->harga }}" 
                                        class="input-clean text-xl text-slate-800 font-black">
                                </div>
                            </td>
                            <td class="px-6 py-2 last:rounded-r-[2rem] border-y border-r border-slate-50 text-center">
                                <div class="flex justify-center gap-3">
                                    <button type="submit" form="update-{{ $menu->id }}" 
                                        class="bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white font-black py-3 px-6 rounded-2xl text-[11px] uppercase transition shadow-sm">
                                        Update
                                    </button>
                                    
                                    <form method="POST" action="/menu/{{ $menu->id }}">
                                        @csrf @method('DELETE')
                                        <button type="submit" onclick="return confirm('Hapus menu ini?')" 
                                            class="bg-red-50 text-red-600 hover:bg-red-600 hover:text-white font-black py-3 px-6 rounded-2xl text-[11px] uppercase transition shadow-sm">
                                        Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>