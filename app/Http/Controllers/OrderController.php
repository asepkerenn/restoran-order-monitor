<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    public function welcome()
    {
        return view('welcome'); 
    }

    public function order()
    {
        $menus = Menu::all();
        // Menggunakan folder order.order sesuai struktur foldermu
        return view('order.order', compact('menus'));
    }

    public function store(Request $request)
    {
        // Validasi: Pastikan ada menu yang dipesan
        if (!$request->qty || array_sum($request->qty) == 0) {
            return back()->with('error', 'Silakan pilih minimal 1 menu sebelum memesan.');
        }

        // 1. Buat data Order Utama (Nama kolom disesuaikan dengan database kamu)
        $order = Order::create([
            'nama_pemesan' => $request->nama, // 'nama_pemesan' adalah kolom di DB
            'nomor_meja'   => $request->meja, // 'nomor_meja' adalah kolom di DB
            'total'        => 0
        ]);

        $total = 0;

        // 2. Simpan Detail Item yang dipesan
        foreach ($request->menu_id as $i => $menu_id) {
            $quantity = $request->qty[$i];
            
            if ($quantity > 0) {
                $menu = Menu::find($menu_id);
                $subtotal = $menu->harga * $quantity;

                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_id'  => $menu_id,
                    'qty'      => $quantity,
                    'subtotal' => $subtotal
                ]);

                $total += $subtotal;
            }
        }

        // 3. Update Total Harga di Order Utama
        $order->update(['total' => $total]);

        // 4. Simpan ID order di session agar bisa dipanggil di halaman thanks
        session(['last_order_id' => $order->id]);

        return redirect()->route('order.thanks');
    }

    public function thanks()
{
    // Mengambil pesanan terakhir berdasarkan ID yang disimpan di session saat checkout
    $orderId = session('last_order_id');
    $order = \App\Models\Order::find($orderId);

    // Jika session hilang, ambil pesanan paling baru sebagai cadangan
    if (!$order) {
        $order = \App\Models\Order::latest()->first();
    }

    return view('order.thanks', compact('order'));

    }
}