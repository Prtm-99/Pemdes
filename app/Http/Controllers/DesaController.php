<?php

namespace App\Http\Controllers;

use App\Desa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class DesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */public function index()
    {
        // Ambil data pertama, jika tidak ada, buat data kosong dengan ID 1
        $desa = Desa::first();
        if (!$desa) {
            $desa = new Desa(); 
        }
        return view('desa.index', compact('desa'));
    }

 public function update(Request $request)
    {
        $desa = Desa::first();

        if ($request->ajax()) {
            $validator = Validator::make($request->all(),[
                'logo'   => ['required', 'image', 'max:2048']
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error'     => true,
                    'message'   => $validator->errors()->all()
                ]);
            }

            if (!$desa) {
                $desa = new Desa();
            }

            // Hapus logo lama jika ada (dan bukan logo default)
            if ($desa->logo && $desa->logo != 'logo.png') {
                File::delete(storage_path('app/public/' . str_replace('public/', '', $desa->logo)));
            }

            // Simpan gambar baru ke folder storage/app/public/logo
            $desa->logo = $request->file('logo')->store('logo', 'public');
            $desa->save();

            return response()->json([
                'error'     => false,
                'data'      => ['logo'   => $desa->logo]
            ]);
            
        } else {
            $data = $request->validate([
                'nama_desa'             => ['required', 'max:64', 'string'],
                'nama_kecamatan'        => ['required', 'max:64', 'string'],
                'nama_kabupaten'        => ['required', 'max:64', 'string'],
                'alamat'                => ['required', 'string'],
                'nama_kepala_desa'      => ['required', 'max:64', 'string'],
                'alamat_kepala_desa'    => ['required', 'string']
            ]);

            if ($desa) {
                // Jika data sudah ada, lakukan update biasa
                $desa->update($data);
            } else {
                // Jika data BELUM ADA sama sekali, wajib isi nilai default untuk kolom 'logo'
                $data['logo'] = 'logo.png'; 
                Desa::create($data);
            }

            return redirect()->back()->with('success','Profil desa berhasil diperbarui');
        }
    }

}
