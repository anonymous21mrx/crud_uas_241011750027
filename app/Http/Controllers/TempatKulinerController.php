<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TempatKuliner;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class TempatKulinerController extends Controller
{
    public function index()
    {
        $data = TempatKuliner::all();
        return view('admin.tempat-kuliner.index', compact('data'));
    }

    public function create()
    {
        return view('admin.tempat-kuliner.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_tempat' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'alamat' => 'required|string',
            'jenis_makanan' => 'required|string|max:255',
            'jam_operasional' => 'required|string|max:255',
        ]);

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('gambar_kuliner', 'public');
            $validated['gambar'] = $path;
        }

        TempatKuliner::create($validated);

        return redirect()->route('admin.tempat-kuliner.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(TempatKuliner $tempatKuliner)
    {
        return view('admin.tempat-kuliner.edit', compact('tempatKuliner'));
    }

    public function update(Request $request, TempatKuliner $tempatKuliner)
    {
        $validated = $request->validate([
            'nama_tempat' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'alamat' => 'required|string',
            'jenis_makanan' => 'required|string|max:255',
            'jam_operasional' => 'required|string|max:255',
        ]);

        if ($request->hasFile('gambar')) {
            if ($tempatKuliner->gambar) {
                Storage::disk('public')->delete($tempatKuliner->gambar);
            }
            $path = $request->file('gambar')->store('gambar_kuliner', 'public');
            $validated['gambar'] = $path;
        }

        $tempatKuliner->update($validated);

        return redirect()->route('admin.tempat-kuliner.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy(TempatKuliner $tempatKuliner)
    {
        if ($tempatKuliner->gambar) {
            Storage::disk('public')->delete($tempatKuliner->gambar);
        }
        $tempatKuliner->delete();

        return redirect()->route('admin.tempat-kuliner.index')->with('success', 'Data berhasil dihapus');
    }

    public function exportPdf()
    {
        $data = TempatKuliner::all();
        $pdf = Pdf::loadView('admin.tempat-kuliner.pdf', compact('data'));
        return $pdf->download('laporan-tempat-kuliner.pdf');
    }
}
