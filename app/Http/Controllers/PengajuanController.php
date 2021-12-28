<?php

namespace App\Http\Controllers;

use App\Models\Sempro;
use App\Models\Skripsi;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    public function sempro(Request $request)
    {
        $data = Sempro::create([
            'mahasiswa_id' => auth('mahasiswa')->user()->id,
            'judul_1' => $request->judul_1,
            'judul_2' => $request->judul_2,
            'judul_3' => $request->judul_3,
            'pembimbing_1' => $request->pembimbing_1,
            'pembimbing_2' => $request->pembimbing_2,
            'status' => 'Belum Disetujui'
        ]);
        if ($data) {
            return response()->json([
                'status' => true,
                'message' => 'Pengajuan berhasil'
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Pengajuan gagal'
        ]);
    }

    public function skripsi(Request $request)
    {
        if ($request->hasFile('file')) {
            $name = $request->file('file')->getClientOriginalName();
            $path = $request->file('file')->store('files');
        }

        $data = Skripsi::create([
            'mahasiswa_id' => auth('mahasiswa')->user()->id,
            'judul' => $request->judul,
            'pembimbing_1' => $request->pembimbing_1,
            'pembimbing_2' => $request->pembimbing_2,
            'status' => 'Belum Disetujui',
            'file' => $path
        ]);
        if ($data) {
            return response()->json([
                'status' => true,
                'message' => 'Pengajuan berhasil'
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Pengajuan gagal'
        ]);
    }
}
