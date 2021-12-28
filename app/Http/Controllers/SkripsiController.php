<?php

namespace App\Http\Controllers;

use App\Models\Skripsi;
use Illuminate\Http\Request;

class SkripsiController extends Controller
{
    public function getSkripsi()
    {
        $data = Skripsi::with('mahasiswa')->get();
        return response()->json([
            'status' => true,
            'message' => 'Pengajuan Skripsi',
            'data' => $data
        ]);
    }

    public function getSkripsiDetail($id)
    {
        $data = Skripsi::with('mahasiswa')->find($id);
        return response()->json([
            'status' => true,
            'message' => 'Pengajuan Skripsi',
            'data' => $data
        ]);
    }
}
