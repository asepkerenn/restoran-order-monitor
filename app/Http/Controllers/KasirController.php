<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class KasirController extends Controller
{
    public function index()
    {
        $orders = Order::with('items.menu')->latest()->get();
        
        // MENGHITUNG TOTAL DARI SEMUA ORDERAN
        $totalPendapatan = $orders->sum('total');

        return view('kasir.order', compact('orders', 'totalPendapatan'));
    }

    // FITUR HAPUS SELURUHNYA
    public function clearAll()
    {
        // Ini akan menghapus semua data di tabel orders
        Order::truncate(); 
        return back()->with('success', 'Semua orderan telah dibersihkan!');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return back()->with('success', 'Pesanan diselesaikan.');
    }
}