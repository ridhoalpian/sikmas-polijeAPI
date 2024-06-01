<?php

namespace App\Http\Controllers;

use App\Models\ProgamKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ProkerController extends Controller
{
    public function index(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
        ]);

        $user_id = $validatedData['user_id'];

        $proker = ProgamKerja::where('user_id', $user_id)->get();

        return response()->json($proker);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'nama_proker' => 'required|string|max:50',
            'penanggung_jawab' => 'required|string|max:50',
            'uraian_proker' => 'required|string|max:150',
            'periode' => 'required|integer',
            'lampiran_proker' => 'required|file|mimes:pdf|max:2048', // Validasi untuk file PDF
        ]);

        try {
            $user_id = $validatedData['user_id'];

            // Menyimpan file lampiran jika ada
            $lampiranProkerPath = null;
            if ($request->hasFile('lampiran_proker')) {
                $lampiranProkerPath = $request->file('lampiran_proker')->store('lampiran', 'public');
            }

            $proker = ProgamKerja::create([
                'user_id' => $user_id,
                'nama_proker' => $validatedData['nama_proker'],
                'penanggung_jawab' => $validatedData['penanggung_jawab'],
                'uraian_proker' => $validatedData['uraian_proker'],
                'periode' => $validatedData['periode'],
                'lampiran_proker' => $lampiranProkerPath,
            ]);

            return response()->json(['success' => true, 'message' => 'Data proker berhasil disimpan']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}