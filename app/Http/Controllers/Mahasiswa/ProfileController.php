<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\ProgramStudiModel;
use App\Models\KompetensiModel;
use App\Models\JenisPerusahaanModel;
use App\Models\DokumenModel;
use App\Models\JenisDokumenModel;
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

    public function uploadDokumen(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'dokumen' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120', // Max 5MB
            'jenis_dokumen' => 'required|string|in:curriculum vitae,portofolio,sertifikat,surat pengantar,transkip nilai'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'File tidak valid',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $user = Auth::user();
            $mahasiswa = $user->mahasiswa;

            if (!$mahasiswa) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data mahasiswa tidak ditemukan'
                ], 404);
            }

            // Cari jenis dokumen
            $jenisDokumen = JenisDokumenModel::where('nama', $request->jenis_dokumen)->first();
            if (!$jenisDokumen) {
                return response()->json([
                    'success' => false,
                    'message' => 'Jenis dokumen tidak valid'
                ], 400);
            }

            // Hapus dokumen lama jika ada
            $existingDokumen = DokumenModel::where('id_mahasiswa', $mahasiswa->id_mahasiswa)
                ->where('id_jenis_dokumen', $jenisDokumen->id_jenis_dokumen)
                ->first();

            if ($existingDokumen && $existingDokumen->path_dokumen) {
                Storage::delete($existingDokumen->path_dokumen);
                $existingDokumen->delete();
            }

            // Upload file baru
            $file = $request->file('dokumen');
            $fileName = time() . '_' . $request->jenis_dokumen . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('dokumen', $fileName, 'public');

            // Simpan ke database
            DokumenModel::create([
                'nama_dokumen' => $fileName,
                'id_jenis_dokumen' => $jenisDokumen->id_jenis_dokumen,
                'id_mahasiswa' => $mahasiswa->id_mahasiswa,
                'path_dokumen' => $filePath,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Dokumen berhasil diunggah!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengunggah dokumen: ' . $e->getMessage()
            ], 500);
        }
    }

    public function hapusDokumen(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jenis_dokumen' => 'required|string|in:curriculum vitae,portofolio,sertifikat,surat pengantar,transkip nilai'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Jenis dokumen tidak valid',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $user = Auth::user();
            $mahasiswa = $user->mahasiswa;

            if (!$mahasiswa) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data mahasiswa tidak ditemukan'
                ], 404);
            }

            // Cari jenis dokumen
            $jenisDokumen = JenisDokumenModel::where('nama', $request->jenis_dokumen)->first();
            if (!$jenisDokumen) {
                return response()->json([
                    'success' => false,
                    'message' => 'Jenis dokumen tidak valid'
                ], 400);
            }

            // Cari dokumen yang akan dihapus
            $dokumen = DokumenModel::where('id_mahasiswa', $mahasiswa->id_mahasiswa)
                ->where('id_jenis_dokumen', $jenisDokumen->id_jenis_dokumen)
                ->first();

            if (!$dokumen) {
                return response()->json([
                    'success' => false,
                    'message' => 'Dokumen tidak ditemukan'
                ], 404);
            }

            // Hapus file dari storage
            if ($dokumen->path_dokumen && Storage::disk('public')->exists($dokumen->path_dokumen)) {
                Storage::disk('public')->delete($dokumen->path_dokumen);
            }

            // Hapus dari database
            $dokumen->delete();

            return response()->json([
                'success' => true,
                'message' => 'Dokumen berhasil dihapus!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus dokumen: ' . $e->getMessage()
            ], 500);
        }
    }
}