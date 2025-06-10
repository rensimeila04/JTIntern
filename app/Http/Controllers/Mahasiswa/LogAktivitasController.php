<?php

namespace App\Http\Controllers\mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LogAktivitasModel;
use App\Models\MagangModel;

class LogAktivitasController extends Controller
{
    public function index()
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Log Aktivitas', 'url' => 'mahasiswa.log_aktivitas'],
        ];

        $activeMenu = 'log-aktivitas';

        // Ambil id_mahasiswa dari user yang login
        $user = auth()->user();
        $mahasiswa = $user->mahasiswa; // pastikan relasi 'mahasiswa' ada di UserModel

        // Ambil magang aktif (atau sesuaikan kebutuhan)
        $magang = MagangModel::where('id_mahasiswa', $mahasiswa->id_mahasiswa)->latest()->first();

        // Ambil log aktivitas berdasarkan id_magang
        $logAktivitas = LogAktivitasModel::where('id_magang', $magang->id_magang ?? null)
            ->orderByDesc('tanggal')
            ->paginate(10);

        return view('mahasiswa.log_aktivitas', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'logAktivitas' => $logAktivitas,
        ]);
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $mahasiswa = $user->mahasiswa;
        $magang = \App\Models\MagangModel::where('id_mahasiswa', $mahasiswa->id_mahasiswa)->latest()->first();

        $validated = $request->validate([
            'tanggal_log' => 'required|date',
            'waktu_awal' => 'required|date_format:H:i',
            'waktu_akhir' => 'required|date_format:H:i|after:waktu_awal',
            'deskripsi' => 'required|string|max:100',
        ]);

        // Check if log already exists for this date
        $existingLog = LogAktivitasModel::where('id_magang', $magang->id_magang)
            ->where('tanggal', $validated['tanggal_log'])
            ->first();

        if ($existingLog) {
            // Format the date for Indonesian display
            $tanggal = \Carbon\Carbon::parse($validated['tanggal_log'])->locale('id')->translatedFormat('l, d F Y');
            return response()->json([
                'success' => false, 
                'message' => "Anda sudah menambahkan log aktivitas di hari {$tanggal}"
            ]);
        }

        try {
            $log = new \App\Models\LogAktivitasModel();
            $log->id_magang = $magang->id_magang;
            $log->tanggal = $validated['tanggal_log'];
            $log->jam_masuk = $validated['waktu_awal'];
            $log->jam_pulang = $validated['waktu_akhir'];
            $log->kegiatan = $validated['deskripsi'];
            $log->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menyimpan log aktivitas.']);
        }
    }

    public function show($id)
    {
        \Carbon\Carbon::setLocale('id'); // Pastikan locale Indonesia
        $log = LogAktivitasModel::find($id);
        if (!$log) {
            return response()->json(['success' => false]);
        }
        return response()->json([
            'success' => true,
            'data' => [
                'tanggal' => $log->tanggal->translatedFormat('l, d F Y'),
                'jam_masuk' => $log->jam_masuk ? \Carbon\Carbon::parse($log->jam_masuk)->format('H.i') : '-',
                'jam_pulang' => $log->jam_pulang ? \Carbon\Carbon::parse($log->jam_pulang)->format('H.i') : '-',
                'kegiatan' => $log->kegiatan,
                'status_feedback' => $log->status_feedback,
                'feedback_dospem' => $log->feedback_dospem,
            ]
        ]);
    }

    public function destroy($id)
    {
        try {
            $log = LogAktivitasModel::findOrFail($id);
            $log->delete();
            
            // For AJAX requests
            if (request()->wantsJson()) {
                return response()->json(['success' => true]);
            }
            
            // For non-AJAX requests or to force redirect
            return redirect()->route('mahasiswa.log_aktivitas')->with('success', 'Log aktivitas berhasil dihapus.');
        } catch (\Exception $e) {
            if (request()->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Gagal menghapus log aktivitas.']);
            }
            return redirect()->back()->with('error', 'Gagal menghapus log aktivitas.');
        }
    }

    public function update(Request $request, $id)
    {
        $log = LogAktivitasModel::findOrFail($id);

        // Ambil data lama jika field tidak dikirim
        $tanggal_log = $request->input('tanggal_log', $log->tanggal);
        $waktu_awal = $request->input('waktu_awal', $log->jam_masuk);
        $waktu_akhir = $request->input('waktu_akhir', $log->jam_pulang);
        $deskripsi = $request->input('deskripsi', $log->kegiatan);

        // Validasi hanya field yang dikirim, gunakan value fallback jika tidak ada
        $validated = $request->validate([
            'tanggal_log' => ['nullable', 'date'],
            'waktu_awal' => ['nullable', 'date_format:H:i'],
            'waktu_akhir' => ['nullable', 'date_format:H:i', 'after:waktu_awal'],
            'deskripsi' => ['nullable', 'string', 'max:100'],
        ]);

        // Gunakan value fallback jika field tidak dikirim
        $tanggal_log = $validated['tanggal_log'] ?? $log->tanggal;
        $waktu_awal = $validated['waktu_awal'] ?? $log->jam_masuk;
        $waktu_akhir = $validated['waktu_akhir'] ?? $log->jam_pulang;
        $deskripsi = $validated['deskripsi'] ?? $log->kegiatan;

        try {
            // Cek duplikasi tanggal jika tanggal diubah
            if ($tanggal_log != $log->tanggal) {
                $existingLog = LogAktivitasModel::where('id_magang', $log->id_magang)
                    ->where('tanggal', $tanggal_log)
                    ->where('id_log_aktivitas', '!=', $id)
                    ->first();
                if ($existingLog) {
                    $tanggal = \Carbon\Carbon::parse($tanggal_log)->locale('id')->translatedFormat('l, d F Y');
                    return response()->json([
                        'success' => false,
                        'message' => "Anda sudah memiliki log aktivitas di hari {$tanggal}"
                    ]);
                }
            }

            $log->tanggal = $tanggal_log;
            $log->jam_masuk = $waktu_awal;
            $log->jam_pulang = $waktu_akhir;
            $log->kegiatan = $deskripsi;
            $log->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate log aktivitas.',
                'error' => $e->getMessage()
            ]);
        }
    }
}
