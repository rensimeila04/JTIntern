<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserModel;
use App\Models\LevelModel;
use App\Models\DokumenModel;
use App\Models\AdminModel;
use App\Models\DosenPembimbingModel;
use App\Models\MahasiswaModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Pengguna', 'url' => '#'],
        ];

        $activeMenu = 'pengguna';

        // Query builder for users
        $query = UserModel::with('level');
        
        // Filter based on level
        if ($request->filled('level_id') && $request->level_id != 'all') {
            $query->where('id_level', $request->level_id);
        }
        
        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('email', 'LIKE', "%{$searchTerm}%")
                  ->orWhereHas('level', function($q) use ($searchTerm) {
                      $q->where('nama_level', 'LIKE', "%{$searchTerm}%");
                  });
            });
        }

        $user = $query->paginate(10)->appends($request->query());
        $level = LevelModel::all();

        # Hitung jumlah pengguna sesuai dengan levelnya
        $mahasiswaLevelId = LevelModel::where('kode_level', 'MHS')->value('id_level');
        $jumlahMahasiswa = UserModel::where('id_level', $mahasiswaLevelId)->count();

        $dosenLevelId = LevelModel::where('kode_level', 'DSP')->value('id_level');
        $jumlahDosen = UserModel::where('id_level', $dosenLevelId)->count();

        $adminLevelId = LevelModel::where('kode_level', 'ADM')->value('id_level');
        $jumlahAdmin = UserModel::where('id_level', $adminLevelId)->count();

        return view('admin.pengguna', [
            'breadcrumb' => $breadcrumb,
            'user' => $user,
            'level' => $level,
            'jumlahMahasiswa' => $jumlahMahasiswa,
            'jumlahDosen' => $jumlahDosen,
            'jumlahAdmin' => $jumlahAdmin,
            'activeMenu' => $activeMenu,
            'currentFilter' => $request->level_id ?? 'all',
            'currentSearch' => $request->search ?? ''
        ]);
    }

    public function detailDospem(Request $request, $id)
    {
        // Existing code unchanged
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Pengguna', 'url' => route('admin.pengguna')],
            ['label' => 'Detail Dosen Pembimbing', 'url' => '#'],
        ];

        $activeMenu = 'pengguna';

        // Load the user with dosen_pembimbing relationship
        $user = UserModel::with(['dosenPembimbing'])->findOrFail($id);

        if (!$user || !$user->dosenPembimbing) {
            return redirect()->route('admin.pengguna')
                ->with('error', 'Pengguna tidak ditemukan atau bukan dosen pembimbing.');
        }

        // Build query for mahasiswa bimbingan
        $query = \App\Models\MagangModel::with([
            'mahasiswa.user',
            'lowongan.perusahaanMitra'
        ])
            ->where('id_dosen_pembimbing', $user->dosenPembimbing->id_dosen_pembimbing);

        // Filter by status
        if ($request->filled('status') && $request->status != 'all') {
            $query->where('status_magang', $request->status);
        }

        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                // Search in mahasiswa's name or NIM
                $q->whereHas('mahasiswa', function ($subQ) use ($searchTerm) {
                    $subQ->where('nim', 'LIKE', "%{$searchTerm}%")
                        ->orWhereHas('user', function ($userQ) use ($searchTerm) {
                            $userQ->where('name', 'LIKE', "%{$searchTerm}%");
                        });
                })
                    // Or search in lowongan title
                    ->orWhereHas('lowongan', function ($subQ) use ($searchTerm) {
                        $subQ->where('judul_lowongan', 'LIKE', "%{$searchTerm}%")
                            // Or search in perusahaan name
                            ->orWhereHas('perusahaanMitra', function ($companyQ) use ($searchTerm) {
                                $companyQ->where('nama_perusahaan_mitra', 'LIKE', "%{$searchTerm}%");
                            });
                    });
            });
        }

        // Paginate results
        $mahasiswaBimbingan = $query->paginate(10)->appends($request->query());

        return view('admin.detail_dospem', [
            'user' => $user,
            'dosenPembimbing' => $user->dosenPembimbing,
            'mahasiswaBimbingan' => $mahasiswaBimbingan,
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'currentStatus' => $request->status ?? 'all',
            'currentSearch' => $request->search ?? ''
        ]);
    }

    public function detailMahasiswa($id)
    {
        // Existing code unchanged
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Pengguna', 'url' => route('admin.pengguna')],
            ['label' => 'Detail Mahasiswa', 'url' => '#'],
        ];

        $activeMenu = 'pengguna';

        // Load user with mahasiswa relationship and all related data
        $user = UserModel::with([
            'mahasiswa.programStudi',
            'mahasiswa.kompetensi',
            'mahasiswa.jenisPerusahaan',
            'mahasiswa.magang.lowongan.perusahaanMitra',
            'mahasiswa.magang.dosenPembimbing.user'
        ])->findOrFail($id);

        if (!$user || !$user->mahasiswa) {
            return redirect()->route('admin.pengguna')
                ->with('error', 'Pengguna tidak ditemukan atau bukan mahasiswa.');
        }

        // Get all documents uploaded by this student
        $dokumen = DokumenModel::with('jenisDokumen')
            ->where('id_mahasiswa', $user->mahasiswa->id_mahasiswa)
            ->get();

        // Get latest internship if any
        $latestMagang = $user->mahasiswa->magang()->latest()->first();

        return view('admin.detail_mahasiswa', [
            'user' => $user,
            'mahasiswa' => $user->mahasiswa,
            'dokumen' => $dokumen,
            'latestMagang' => $latestMagang,
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu
        ]);
    }

    public function detailAdmin($id)
    {
        // Existing code unchanged
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Pengguna', 'url' => route('admin.pengguna')],
            ['label' => 'Detail Pengguna', 'url' => '#'],
        ];

        $activeMenu = 'pengguna';


        $user = UserModel::with('admin')->findOrFail($id);

        if (!$user || !$user->admin) {
            return redirect()->route('admin.pengguna')
                ->with('error', 'Pengguna tidak ditemukan atau bukan admin.');
        }

        return view('admin.detail_admin', [
            'user' => $user,
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
        ]);
    }

    public function edit() 
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Edit Pengguna', 'url' => '#'],
        ];

        $activeMenu = '';

        return view('admin.edit_profile', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu
        ]);
    }

    public function create()
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Pengguna', 'url' => route('admin.pengguna')],
            ['label' => 'Tambah Pengguna', 'url' => '#'],
        ];

        $activeMenu = 'pengguna';

        $levels = LevelModel::all();

        return view('admin.tambah_pengguna', [
            'breadcrumb' => $breadcrumb,
            'levels' => $levels,
            'activeMenu' => $activeMenu
        ]);
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|string|min:8|confirmed',
            'id_level' => 'required|exists:level,id_level',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Create new user
        $user = new UserModel();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->id_level = $request->id_level;

        // Handle profile photo if uploaded
        if ($request->hasFile('profile_photo') && $request->file('profile_photo')->isValid()) {
            try {
                $photo = $request->file('profile_photo');
                $photoName = time() . '_' . str_replace(' ', '_', $photo->getClientOriginalName());

                // // Pastikan direktori ada
                // if (!file_exists(public_path('images'))) {
                //     mkdir(public_path('images'), 0777, true);
                // }

                // Simpan ke folder public/images
                $photo->move(public_path('images'), $photoName);

                // Update path pada database
                $user->profile_photo = $photoName;
            } catch (\Exception $e) {
                // Log error
                Log::error('Error uploading profile photo: ' . $e->getMessage());
                return redirect()->back()->withInput()
                    ->with('error', 'Gagal mengunggah foto: ' . $e->getMessage());
            }
        }

        $user->save();

        // Get level name for display in success message
        $levelName = LevelModel::find($request->id_level)->nama_level ?? '';

        // Create related model based on level
        $this->createRelatedModelForUser($user, $levelName);

        // Redirect with success message and user name for the confirmation modal
        return redirect()->route('admin.pengguna.create')
            ->with('success', 'Pengguna berhasil ditambahkan.')
            ->with('user_name', $request->name);
    }

    /**
     * Create related model based on user level (Admin, Dosen, Mahasiswa)
     */
    private function createRelatedModelForUser($user, $levelName)
    {
        // Create related model based on level
        if (stripos($levelName, 'admin') !== false) {
            // Create Admin record
            $admin = new AdminModel();
            $admin->id_user = $user->id_user;
            $admin->save();
        } elseif (stripos($levelName, 'dosen') !== false) {
            // Create Dosen record
            $dosen = new DosenPembimbingModel();
            $dosen->id_user = $user->id_user;
            $dosen->save();
        } elseif (stripos($levelName, 'mahasiswa') !== false) {
            // Create Mahasiswa record
            $mahasiswa = new MahasiswaModel();
            $mahasiswa->id_user = $user->id_user;
            $mahasiswa->save();
        }
    }

    public function update(Request $request, $id)
    {
        try {
            // Log the request data for debugging
            Log::info('Update user request:', [
                'id' => $id,
                'request_data' => $request->all()
            ]);

            // Validate the request
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:user,email,' . $id . ',id_user',
                'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Find the user
            $user = UserModel::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;

            // Handle profile photo if uploaded
            if ($request->hasFile('profile_photo') && $request->file('profile_photo')->isValid()) {
                try {
                    // Delete old photo if exists
                    if ($user->profile_photo && Storage::exists('public/' . $user->profile_photo)) {
                        Storage::delete('public/' . $user->profile_photo);
                    }

                    $photo = $request->file('profile_photo');
                    $photoName = time() . '_' . str_replace(' ', '_', $photo->getClientOriginalName());

                    // Simpan ke folder storage/app/public
                    $photo->storeAs('public', $photoName);

                    // Update path pada database
                    $user->profile_photo = $photoName;
                } catch (\Exception $e) {
                    // Log error
                    Log::error('Error uploading profile photo: ' . $e->getMessage());

                    // For AJAX requests
                    if ($request->expectsJson()) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Gagal mengunggah foto: ' . $e->getMessage()
                        ], 422);
                    }

                    return redirect()->back()->withInput()
                        ->with('error', 'Gagal mengunggah foto: ' . $e->getMessage());
                }
            }

            // Save the user
            $user->save();

            // For AJAX requests
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Pengguna berhasil diperbarui',
                    'user_name' => $user->name
                ]);
            }

            // Return to the pengguna page with success message
            return redirect()->route('admin.pengguna')
                ->with('success', 'Pengguna berhasil diperbarui.')
                ->with('user_name', $user->name);
        } catch (\Exception $e) {
            Log::error('Error updating user:', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            // For AJAX requests
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->back()->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            // Find the user
            $user = UserModel::findOrFail($id);
            $userName = $user->name;

            // Get user level for informational purposes
            $userLevel = $user->level->nama_level ?? 'Pengguna';

            // Delete based on user level
            // Let the model relationships handle the cascading delete
            // Model event listeners will fire and trigger database foreign key constraints
            $user->delete();

            // For AJAX requests
            if (request()->ajax() || request()->wantsJson() || request()->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => "$userLevel \"$userName\" berhasil dihapus."
                ]);
            }

            // Return to the users page with success message
            return redirect()->route('admin.pengguna')
                ->with('success', "$userLevel berhasil dihapus.")
                ->with('message', "$userLevel \"$userName\" berhasil dihapus.");
        } catch (\Exception $e) {
            Log::error('Error deleting user:', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            // For AJAX requests
            if (request()->ajax() || request()->wantsJson() || request()->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat menghapus pengguna: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menghapus pengguna: ' . $e->getMessage());
        }
    }
}
