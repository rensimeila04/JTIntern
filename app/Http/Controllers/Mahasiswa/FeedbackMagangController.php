<?php

namespace App\Http\Controllers\mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\MagangModel;
use App\Models\FeedbackModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FeedbackMagangController extends Controller
{
    public function index()
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Feedback Magang', 'url' => route('mahasiswa.feedback')],
        ];

        $activeMenu = 'feedback';

        // Ambil ID mahasiswa dari user yang login
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa;

        // Cek apakah mahasiswa ditemukan, cek status magang
        if ($mahasiswa) {
            // Ambil data magang mahasiswa dengan status 'selesai
            $magang = MagangModel::where('id_mahasiswa', $mahasiswa->id_mahasiswa)
                ->where('status_magang', 'selesai')
                ->first();

            if ($magang) {
                // Cek apakah mahasiswa sudah mengirimkan feedback
                $existingFeedback = FeedbackModel::where('id_magang', $magang->id_magang)
                    ->where('id_mahasiswa', $mahasiswa->id_mahasiswa)
                    ->first();

                // Kirim data ke view
                return view('mahasiswa.feedback_magang', [
                    'breadcrumb' => $breadcrumb,
                    'activeMenu' => $activeMenu,
                    'magang' => $magang,
                    'magangSelesai' => true,
                    'feedbackSudahDikirim' => $existingFeedback ? true : false
                ]);
            }
        }
        return view('mahasiswa.feedback_magang', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'magang' => null,
            'magangSelesai' => false,
        ]);
    }

    public function store(Request $request)
    {
        try {
            // Validasi input
            $validated = $request->validate([
                'id_magang' => 'required|exists:magang,id_magang',
                'komentar' => 'required|string|max:300',
                'rating' => 'required|integer|min:1|max:5',
                'kepuasan_rekomendasi' => 'required|string',
                'kesesuaian_rekomendasi' => 'required|string',
            ]);

            // Cek apakah sudah pernah submit feedback
            $existingFeedback = FeedbackModel::where('id_magang', $validated['id_magang'])
                ->where('id_mahasiswa', Auth::user()->mahasiswa->id_mahasiswa)
                ->first();

            if ($existingFeedback) {
                return redirect()->route('mahasiswa.feedback')->with('error', 'Anda sudah pernah mengirimkan feedback untuk magang ini.');
            }

            // Simpan feedback ke database
            $feedback = new FeedbackModel();
            $feedback->id_magang = $validated['id_magang'];
            $feedback->id_mahasiswa = Auth::user()->mahasiswa->id_mahasiswa;
            $feedback->komentar = $validated['komentar'];
            $feedback->rating = $validated['rating'];
            $feedback->kepuasan_rekomendasi = $validated['kepuasan_rekomendasi'];
            $feedback->kesesuaian_rekomendasi = $validated['kesesuaian_rekomendasi'];
            $feedback->save();

            return redirect()->route('mahasiswa.feedback')->with('success', 'Terima kasih! Feedback Anda telah berhasil dikirim.');
        } catch (\Exception $e) {
            // Log error
            Log::error('Error saving feedback: ' . $e->getMessage());

            return redirect()->route('mahasiswa.feedback')->with('error', 'Terjadi kesalahan saat mengirim feedback. Silakan coba lagi.');
        }
    }
}
