<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\TempatKuliner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::with('tempatKuliner')->get();
        return view('admin.menu.index', compact('menus'));
    }

    public function create()
    {
        $tempatKuliners = TempatKuliner::all();
        return view('admin.menu.create', compact('tempatKuliners'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tempat_kuliner_id' => 'required|exists:tempat_kuliners,id',
            'nama_menu' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $extension = $file->getClientOriginalExtension();
            $base64 = base64_encode(file_get_contents($file));
            $data['gambar'] = 'data:image/' . $extension . ';base64,' . $base64;
        }

        Menu::create($data);

        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $menu = Menu::findOrFail($id);
        $tempatKuliners = TempatKuliner::all();
        return view('admin.menu.edit', compact('menu', 'tempatKuliners'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'tempat_kuliner_id' => 'required|exists:tempat_kuliners,id',
            'nama_menu' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $menu = Menu::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $extension = $file->getClientOriginalExtension();
            $base64 = base64_encode(file_get_contents($file));
            $data['gambar'] = 'data:image/' . $extension . ';base64,' . $base64;
        }

        $menu->update($data);

        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $menu = Menu::findOrFail($id);
        
        if ($menu->gambar) {
            Storage::disk('public')->delete($menu->gambar);
        }
        
        $menu->delete();

        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil dihapus.');
    }
}
