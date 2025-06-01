<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\ProgramStudiModel;
use App\Models\KompetensiModel;
use App\Models\JenisPerusahaanModel;
use App\Models\DokumenModel;
use App\Models\MahasiswaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function edit()
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Edit Profil Pengguna', 'url' => '#'],
        ];
        
        $activeMenu = '';
        
        $programStudi = ProgramStudiModel::all();
        $kompetensi = KompetensiModel::all();
        $jenisPerusahaan = JenisPerusahaanModel::all();

        // Ambil mahasiswa yang sedang login
        $mahasiswa = Auth::user()->mahasiswa;

        // Ambil dokumen milik mahasiswa
        $dokumen = [];
        if ($mahasiswa) {
            $dokumen = DokumenModel::with('jenisDokumen')
                ->where('id_mahasiswa', $mahasiswa->id_mahasiswa)
                ->get()
                ->keyBy(fn($d) => strtolower($d->jenisDokumen->nama ?? ''));
        }

        return view('mahasiswa.edit_profile', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'programStudi' => $programStudi,
            'kompetensi' => $kompetensi,
            'jenisPerusahaan' => $jenisPerusahaan,
            'dokumen' => $dokumen,
        ]);
    }

    public function updatePreferensi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jenis_magang' => 'required|in:wfo,remote,hybrid',
            'kompetensi' => 'required|exists:kompetensi,id_kompetensi',
            'jenis_perusahaan' => 'required|exists:jenis_perusahaan,id_jenis_perusahaan',
            'preferensi_lokasi' => 'required|string|max:255',
            'latitude_preferensi' => 'nullable|numeric|between:-90,90',
            'longitude_preferensi' => 'nullable|numeric|between:-180,180',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $user = Auth::user();
            $mahasiswa = $user->mahasiswa;

            if (!$mahasiswa) {
                // Jika belum ada data mahasiswa, buat baru
                $mahasiswa = MahasiswaModel::create([
                    'id_user' => $user->id_user,
                    'nim' => $user->nim ?? '', // Pastikan ada nim di user atau form
                    'jenis_magang' => $request->jenis_magang,
                    'id_kompetensi' => $request->kompetensi,
                    'id_program_studi' => $user->program_studi_id ?? 1, // Default atau dari form
                    'preferensi_lokasi' => $request->preferensi_lokasi,
                    'latitude_preferensi' => $request->latitude_preferensi,
                    'longitude_preferensi' => $request->longitude_preferensi,
                    'id_jenis_perusahaan' => $request->jenis_perusahaan,
                ]);
            } else {
                // Update data yang sudah ada
                $mahasiswa->update([
                    'jenis_magang' => $request->jenis_magang,
                    'id_kompetensi' => $request->kompetensi,
                    'preferensi_lokasi' => $request->preferensi_lokasi,
                    'latitude_preferensi' => $request->latitude_preferensi,
                    'longitude_preferensi' => $request->longitude_preferensi,
                    'id_jenis_perusahaan' => $request->jenis_perusahaan,
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Preferensi magang berhasil diperbarui!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui preferensi: ' . $e->getMessage()
            ], 500);
        }
    }
}