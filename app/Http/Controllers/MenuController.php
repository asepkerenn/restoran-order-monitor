<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return view('kasir.menu', compact('menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'  => 'required|string',
            'harga' => 'required|numeric',
        ]);

        Menu::create([
            'nama'  => $request->nama,
            'harga' => $request->harga,
        ]);

        return redirect('/menu');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'  => 'required|string',
            'harga' => 'required|numeric',
        ]);

        $menu = Menu::findOrFail($id);
        $menu->update([
            'nama'  => $request->nama,
            'harga' => $request->harga,
        ]);

        return redirect('/menu');
    }

    public function destroy($id)
    {
        Menu::findOrFail($id)->delete();
        return redirect('/menu');
    }
}
