<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class PrestasiController extends Controller
{
    public function store(Request $request)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'user_id' => 'required|integer|exists:users,id', // Validasi user_id
            'namalomba' => 'required|string|max:50',
            'kategorilomba' => 'required|in:individu,kelompok',
            'tanggallomba' => 'required|date',
            'juara' => 'required|string|in:Juara 1,Juara 2,Juara 3,Harapan 1,Harapan 2,lainnya',
            'penyelenggara' => 'required|string|max:30',
            'lingkup' => 'required|string|in:kabupaten,provinsi,nasional,lainnya',
            'sertifikat' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'dokumentasi' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Simpan gambar sertifikat
        $sertifikatPath = $request->file('sertifikat')->store('sertifikat', 'public');

        // Simpan gambar dokumentasi
        $dokumentasiPath = $request->file('dokumentasi')->store('dokumentasi', 'public');

        // Buat data prestasi baru
        $prestasi = new Prestasi;
        $prestasi->user_id = $validatedData['user_id']; // Mendapatkan user_id dari request
        $prestasi->namalomba = $validatedData['namalomba'];
        $prestasi->kategorilomba = $validatedData['kategorilomba'];
        $prestasi->tanggallomba = $validatedData['tanggallomba'];
        $prestasi->juara = $validatedData['juara'];
        $prestasi->penyelenggara = $validatedData['penyelenggara'];
        $prestasi->lingkup = $validatedData['lingkup'];
        $prestasi->sertifikat = $sertifikatPath;
        $prestasi->dokumentasi = $dokumentasiPath;
        $prestasi->statusprestasi = $request->input('statusprestasi', 'belum disetujui'); // Default value if not provided
        $prestasi->save();

        // Kembalikan respons JSON
        return response()->json(['success' => true, 'message' => 'Data prestasi berhasil disimpan']);
    }

    public function index(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
        ]);

        $user_id = $validatedData['user_id'];

        $prestasi = Prestasi::where('user_id', $user_id)->get();

        return response()->json($prestasi);
    }
}
