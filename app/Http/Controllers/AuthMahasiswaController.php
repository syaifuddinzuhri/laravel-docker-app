<?php

namespace App\Http\Controllers;

use App\Constant\UploadPathConstant;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Traits\ImageHandlerTrait;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthMahasiswaController extends Controller
{
    use ImageHandlerTrait;
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $mhs = Mahasiswa::where('email', $request->email)->first();
        if ($mhs) {
            if ($mhs->status) {
                if (Hash::check($request->password, $mhs->password)) {
                    if (!$token = auth('mahasiswa')->login($mhs)) {
                        return response()->json(['error' => 'Unauthorized'], 401);
                    }
                    return $this->respondWithToken($token);
                }
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Akun kamu belum diverifikasi'
                ], 401);
            }
        }
        return response()->json([
            'status' => false,
            'message' => 'Email atau password gagal'
        ], 401);
    }

    public function register(Request $request)
    {
        $data = Mahasiswa::create([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'email' => $request->email,
            'kelas' => $request->kelas,
            'prodi' => $request->prodi,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'password' => $request->password,
        ]);

        if ($data) {
            return response()->json([
                'status' => true,
                'message' => 'Registrasi berhasil'
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Registrasi gagal'
        ]);
    }

    public function update(Request $request, $id)
    {
        $mhs = Mahasiswa::find($id);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $file_name = ImageHandlerTrait::uploadImage($file,  UploadPathConstant::PHOTO);
        }
        $data = $mhs->update([
            'photo' => $request->hasFile('image') ? $file_name : null,
            'nama' => $request->nama,
            'nim' => $request->nim,
            'email' => $request->email,
            'kelas' => $request->kelas,
            'prodi' => $request->prodi,
            'email' => $request->email,
            'no_hp' => $request->no_hp
        ]);

        if ($data) {
            return response()->json([
                'status' => true,
                'message' => 'Update berhasil',
                'data' => Mahasiswa::find($id)
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Update gagal'
        ]);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth('mahasiswa')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('mahasiswa')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('mahasiswa')->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('mahasiswa')->factory()->getTTL() * 60
        ]);
    }
}
