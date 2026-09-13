<?php

namespace App\Http\Controllers;

use App\UMKM;
use App\Desa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UMKMController extends Controller
{
    public function index()
    {
        $umkms = UMKM::latest()->paginate(10);
        $desa = Desa::find(1);
        
        return view('umkm.index', compact('umkms', 'desa'));
    }
    
    public function create()
    {
        return view('umkm.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'required|string',
            'link' => 'nullable|url',
        ]);

        $data = $request->all();

        // Bersihkan tag <p> kosong atau <p><br></p> dari Summernote
        $cleanDesc = trim(strip_tags($request->deskripsi, '<br>'));
        if (empty($cleanDesc) || $request->deskripsi == '<p><br></p>' || $request->deskripsi == '<p></p>') {
            $data['deskripsi'] = null;
        }

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('umkm_images', 'public');
        }

        UMKM::create($data);

        return redirect()->route('umkm.index')->with('success', 'UMKM berhasil ditambahkan.');
    }

    public function show()
    {
        $umkms = UMKM::latest()->get();
        return view('umkm.show', compact('umkms'));
    }
    
    public function edit(UMKM $umkm)
    {
        return view('umkm.edit', compact('umkm'));
    }

    public function destroy(UMKM $umkm)
    {
        if ($umkm->gambar && $umkm->gambar != 'default.png') {
            Storage::disk('public')->delete($umkm->gambar);
        }

        $umkm->delete();

        return redirect()->route('umkm.index')->with('success', 'UMKM berhasil dihapus.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'required|string',
            'link' => 'nullable|url',
        ]);

        $umkm = UMKM::findOrFail($id);

        $umkm->nama = $request->nama;
        
        // Bersihkan tag <p> kosong atau <p><br></p> dari Summernote saat update
        $cleanDesc = trim(strip_tags($request->deskripsi, '<br>'));
        if (empty($cleanDesc) || $request->deskripsi == '<p><br></p>' || $request->deskripsi == '<p></p>') {
            $umkm->deskripsi = null;
        } else {
            $umkm->deskripsi = $request->deskripsi;
        }

        $umkm->link = $request->link;

        if ($request->hasFile('gambar')) {
            if ($umkm->gambar) {
                Storage::disk('public')->delete($umkm->gambar);
            }
            $umkm->gambar = $request->file('gambar')->store('umkm_images', 'public');
        }

        $umkm->save();

        return redirect()->route('umkm.index')->with('success', 'UMKM berhasil diperbarui!');
    }
}