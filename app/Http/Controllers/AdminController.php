<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Mahasiswa;
use App\Models\Sempro;
use App\Models\Skripsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $adm = Admin::where('email', $request->email)->first();

        if ($adm) {
            if (Hash::check($request->password, $adm->password)) {
                if (!$token = auth('admin')->login($adm)) {
                    return response()->json(['error' => 'Unauthorized'], 401);
                }
                return response()->json([
                    'status' => true,
                    'message' => 'Login berhasil',
                    'token' => $token
                ], 200);
            }
            return response()->json([
                'status' => false,
                'message' => 'Email atau password salah'
            ], 401);
        }
        return response()->json([
            'status' => false,
            'message' => 'Email tidak ditemukan'
        ], 401);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth('admin')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('admin')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function getSempro()
    {
        $data = Sempro::with('mahasiswa')->get();
        return response()->json([
            'status' => true,
            'message' => 'Pengajuan Sempro',
            'data' => $data
        ]);
    }

    public function getSkripsi()
    {
        $data = Skripsi::with('mahasiswa')->get();
        return response()->json([
            'status' => true,
            'message' => 'Pengajuan Skripsi',
            'data' => $data
        ]);
    }

    public function getMahasiswa()
    {
        $data = Mahasiswa::get();
        return response()->json([
            'status' => true,
            'message' => 'Mahasiswa',
            'data' => $data
        ]);
    }

    public function getMahasiswaDetail($id)
    {
        $data = Mahasiswa::find($id);
        return response()->json([
            'status' => true,
            'message' => 'Pengajuan Sempro',
            'data' => $data
        ]);
    }

    public function updateMahasiswa(Request $request, $id)
    {
        $data = Mahasiswa::find($id);
        $data->update([
            'status' => $request->status
        ]);
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

    public function updateSempro(Request $request, $id)
    {
        $data = Sempro::with('mahasiswa')->find($id);
        $data->update([
            'status' => $request->status,
            'waktu' => $request->waktu,
            'tempat' => $request->tempat,
            'link' => $request->link,
            'nama_ruang' => $request->nama_ruang,
            'status_judul_1' => $request->status_judul_1,
            'status_judul_2' => $request->status_judul_2,
            'status_judul_3' => $request->status_judul_3,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Pengajuan Sempro',
            'data' => $data
        ]);
    }

    public function updateSkripsi(Request $request, $id)
    {
        $data = Skripsi::with('mahasiswa')->find($id);
        $data->update([
            'status' => $request->status,
            'waktu' => $request->waktu,
            'tempat' => $request->tempat,
            'link' => $request->link,
            'nama_ruang' => $request->nama_ruang
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Pengajuan Sempro',
            'data' => $data
        ]);
    }

    public function getSkripsiDetail($id)
    {
        $data = Skripsi::with('mahasiswa')->find($id);
        return response()->json([
            'status' => true,
            'message' => 'Pengajuan Sempro',
            'data' => $data
        ]);
    }
}
