<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class KegiatanController extends Controller
{
    public function getKegiatan($user_id)
    {
        $kegiatan = Kegiatan::where('user_id', $user_id)->get();
        return response()->json($kegiatan);
    }
}
