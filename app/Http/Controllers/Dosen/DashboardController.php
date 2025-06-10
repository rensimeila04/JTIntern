<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\MagangModel;
use App\Models\LogAktivitasModel;
use App\Models\MahasiswaModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Dashboard', 'url' => route('dosen.dashboard')],
        ];
        $activeMenu = 'dashboard';

        $countMahasiswaBimbingan = MagangModel::where('id_dosen_pembimbing', auth()->user()->id_dosen_pembimbing)
            ->whereIn('status_magang', ['magang', 'diterima'])
            ->distinct('id_mahasiswa')
            ->count('id_mahasiswa');

        $countMagangAktif = MagangModel::where('id_dosen_pembimbing', auth()->user()->id_dosen_pembimbing)
            ->where('status_magang', 'magang')
            ->count();

        $countMenungguFeedback = LogAktivitasModel::where('status_feedback', 'menunggu')
            ->whereHas('magang', function ($query) {
                $query->where('id_dosen_pembimbing', auth()->user()->id_dosen_pembimbing);
            })
            ->count();

        $logAktivitasTerbaru = LogAktivitasModel::whereHas('magang', function ($query) {
            $query->where('id_dosen_pembimbing', auth()->user()->id_dosen_pembimbing);
        })
            ->with(['magang.mahasiswa']) 
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        return view('dosen.index', compact(
            'breadcrumb',
            'activeMenu',
            'countMahasiswaBimbingan',
            'countMagangAktif',
            'countMenungguFeedback',
            'logAktivitasTerbaru'
        ));
    }

    public function edit()
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Edit Pengguna', 'url' => '#'],
        ];

        $activeMenu = '';

        return view('dosen.edit_profile', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = UserModel::findOrFail(auth()->id());

        $request->validate([
            'name' => 'required|string|max:255',
            'nip' => 'nullable|string|max:50',
            'bidang_minat' => 'nullable|string|max:255',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $user->name = $request->name;

        // Update NIP if dosen relation exists
        if ($user->dosenPembimbing) {
            $user->dosenPembimbing->nip = $request->nip;
            $user->dosenPembimbing->bidang_minat = $request->bidang_minat;
            $user->dosenPembimbing->save();
        }

        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            
            // Debug log before processing
            Log::info('Processing file upload', [
                'original_name' => $file->getClientOriginalName(),
                'real_path' => $file->getRealPath(),
                'mime_type' => $file->getMimeType(),
                'size' => $file->getSize()
            ]);

            if ($file->isValid()) {
                try {
                    // Create a unique filename
                    $extension = $file->getClientOriginalExtension();
                    $filename = uniqid() . '.' . $extension;
                    
                    // Move file directly to storage
                    if ($file->move(storage_path('app/public/profile_photos'), $filename)) {
                        // Delete old photo if exists
                        if ($user->profile_photo) {
                            $old_path = storage_path('app/public/' . $user->profile_photo);
                            if (file_exists($old_path)) {
                                unlink($old_path);
                            }
                        }
                        
                        // Update database with new path
                        $user->profile_photo = 'profile_photos/' . $filename;
                        
                        Log::info('File upload success', [
                            'filename' => $filename,
                            'path' => $user->profile_photo
                        ]);
                    } else {
                        Log::error('Failed to move uploaded file');
                    }
                } catch (\Exception $e) {
                    Log::error('File upload failed', [
                        'error' => $e->getMessage(),
                        'file' => $file->getClientOriginalName()
                    ]);
                }
            }
        }
        $user->save();
        return redirect()->back()->with('success', 'Data pribadi berhasil diperbarui.');
    }

    /**
     * Update account data (email, password)
     */
    public function updateAccount(Request $request)
    {
        $authUser = auth()->user();
        $user = UserModel::findOrFail($authUser->id_user);

        $request->validate([
            'email' => 'required|email|unique:user,email,' . $user->id_user . ',id_user',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        return redirect()->back()->with('success', 'Akun berhasil diperbarui.');
    }
}
