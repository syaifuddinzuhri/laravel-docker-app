<?php

namespace App\Http\Controllers;

use App\Models\Sempro;
use Illuminate\Http\Request;

class SemproController extends Controller
{
    public function getSempro()
    {
        $data = Sempro::with('mahasiswa')->get();
        return response()->json([
            'status' => true,
            'message' => 'Pengajuan Sempro',
            'data' => $data
        ]);
    }
    public function getSemproDetail($id)
    {
        $data = Sempro::with('mahasiswa')->find($id);
        return response()->json([
            'status' => true,
            'message' => 'Pengajuan Sempro',
            'data' => $data
        ]);
    }
}
