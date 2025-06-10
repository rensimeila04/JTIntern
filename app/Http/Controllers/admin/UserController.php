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
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('email', 'LIKE', "%{$searchTerm}%")
                    ->orWhereHas('level', function ($q) use ($searchTerm) {
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

    public function updateProfile(Request $request)
    {
        $user = UserModel::findOrFail(auth()->id());

        $request->validate([
            'name' => 'required|string|max:255',
            'nip' => 'nullable|string|max:50',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user->name = $request->name;

        // Update NIP if admin relation exists
        if ($user->admin) {
            $user->admin->nip = $request->nip;
            $user->admin->save();
        }

        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $path = $file->store('profile_photos', 'public');
            $user->profile_photo = $path;
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

    public function importForm()
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Pengguna', 'url' => route('admin.pengguna')],
            ['label' => 'Import Pengguna', 'url' => '#'],
        ];

        $activeMenu = 'pengguna';

        return view('admin.import_pengguna', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu
        ]);
    }

    /**
     * Download Excel template for user import
     */
    public function downloadTemplate()
    {
        // Path ke file template manual
        $templatePath = public_path('templates/template_import_pengguna.xlsx');

        // Periksa apakah file template ada
        if (!file_exists($templatePath)) {
            return back()->with('error', 'File template tidak ditemukan. Silakan hubungi administrator.');
        }

        // Return file sebagai download
        return response()->download($templatePath, 'template_import_pengguna.xlsx', [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }

    /**
     * Process the imported Excel file
     */
    public function importStore(Request $request)
    {
        // Perbaikan validasi untuk memastikan CSV diterima
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'excel_file' => [
                'required',
                'file',
                function ($attribute, $value, $fail) {
                    // Cek ekstensi file secara manual
                    $extension = strtolower($value->getClientOriginalExtension());
                    if (!in_array($extension, ['csv', 'xlsx', 'xls'])) {
                        $fail('File harus berformat Excel (.xlsx, .xls) atau CSV (.csv).');
                        return;
                    }

                    // Cek ukuran file (max 5MB)
                    if ($value->getSize() > 5242880) {
                        $fail('Ukuran file maksimal 5MB.');
                        return;
                    }
                },
            ],
        ]);

        if ($validator->fails()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            return redirect()->route('admin.pengguna.import')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Proses file yang diupload
            $file = $request->file('excel_file');
            $extension = strtolower($file->getClientOriginalExtension());
            $fileName = $file->getClientOriginalName();
            $filePath = $file->store('imports', 'public');

            $rows = 0; // Jumlah baris yang berhasil diimport
            $errors = [];
            $totalRows = 0;

            // Proses berdasarkan tipe file
            if ($extension == 'csv') {
                // Proses file CSV
                $this->processCSV($file, $rows, $errors);
            } else if ($extension == 'xlsx' || $extension == 'xls') {
                // Proses file XLSX/XLS
                $this->processXLSX($file, $rows, $errors);
            }

            // Jika ada error, tampilkan
            if (!empty($errors)) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Terdapat kesalahan saat import data',
                        'errors' => $errors
                    ], 422);
                }

                return redirect()->route('admin.pengguna.import')
                    ->with('error', 'Terdapat kesalahan saat import data')
                    ->with('errors', $errors);
            }

            // Return sukses response
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data berhasil diimport',
                    'count' => $rows
                ]);
            }

            return redirect()->route('admin.pengguna.import')
                ->with('success', 'Data pengguna berhasil diimport')
                ->with('count', $rows);
        } catch (\Exception $e) {
            Log::error('Error importing users:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->route('admin.pengguna.import')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Process CSV file
     */
    private function processCSV($file, &$rows, &$errors)
    {
        // Buka file CSV
        $handle = fopen($file->getRealPath(), 'r');

        // Baca header
        $header = fgetcsv($handle);

        // Proses setiap baris
        while (($data = fgetcsv($handle)) !== false) {
            // Lewati baris kosong
            if (empty($data[0]) && empty($data[1])) {
                continue;
            }

            try {
                // Buat array data user dari baris CSV
                $userData = [
                    'name' => $data[0] ?? '',
                    'email' => $data[1] ?? '',
                    'password' => $data[2] ?? '',
                    'id_level' => $data[3] ?? '',
                    'profile_photo' => $data[4] ?? null,
                ];

                // Simpan data user
                $this->saveUser($userData, $rows, $errors);
            } catch (\Exception $e) {
                $errors[] = "Error baris " . ($rows + 2) . ": " . $e->getMessage();
            }
        }

        fclose($handle);
    }

    /**
     * Process XLSX file using SimpleXLSX
     */
    private function processXLSX($file, &$rows, &$errors)
    {
        // Gunakan SimpleXLSX untuk membaca file Excel
        $xlsx = new \Shuchkin\SimpleXLSX($file->getRealPath());

        // Ambil semua data dari sheet pertama
        $data = $xlsx->rows();

        // Lewati baris header
        for ($i = 1; $i < count($data); $i++) {
            $row = $data[$i];

            // Lewati baris kosong
            if (empty($row[0]) && empty($row[1])) {
                continue;
            }

            try {
                // Buat array data user dari baris Excel
                $userData = [
                    'name' => $row[0] ?? '',
                    'email' => $row[1] ?? '',
                    'password' => $row[2] ?? '',
                    'id_level' => $row[3] ?? '',
                    'profile_photo' => $row[4] ?? null,
                ];

                // Simpan data user
                $this->saveUser($userData, $rows, $errors);
            } catch (\Exception $e) {
                $errors[] = "Error baris " . ($i + 1) . ": " . $e->getMessage();
            }
        }
    }

    /**
     * Save user data to database
     */
    private function saveUser($userData, &$rows, &$errors)
    {
        // Validasi data
        if (empty($userData['name'])) {
            throw new \Exception('Nama tidak boleh kosong');
        }

        if (empty($userData['email'])) {
            throw new \Exception('Email tidak boleh kosong');
        }

        if (!filter_var($userData['email'], FILTER_VALIDATE_EMAIL)) {
            throw new \Exception('Format email tidak valid');
        }

        if (UserModel::where('email', $userData['email'])->exists()) {
            throw new \Exception('Email ' . $userData['email'] . ' sudah terdaftar');
        }

        if (empty($userData['password']) || strlen($userData['password']) < 8) {
            throw new \Exception('Password harus minimal 8 karakter');
        }

        if (empty($userData['id_level'])) {
            throw new \Exception('Level tidak boleh kosong');
        }

        // Cek level valid
        $level = LevelModel::find($userData['id_level']);
        if (!$level) {
            throw new \Exception('Level tidak valid. Gunakan 1 untuk Admin, 2 untuk Dosen, atau 3 untuk Mahasiswa');
        }

        // Buat user baru
        $user = new UserModel();
        $user->name = $userData['name'];
        $user->email = $userData['email'];
        $user->password = bcrypt($userData['password']);
        $user->id_level = $userData['id_level'];
        $user->profile_photo = $userData['profile_photo'];
        $user->save();

        // Buat model terkait berdasarkan level
        $this->createRelatedModelForUser($user, $level->nama_level);

        $rows++;
    }

    /**
     * Export user data directly to PDF
     */
    public function export(Request $request)
    {
        // Query builder for users
        $query = UserModel::with('level');

        // Filter based on level if provided
        if ($request->filled('level_id') && $request->level_id != 'all') {
            $query->where('id_level', $request->level_id);
        }

        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('email', 'LIKE', "%{$searchTerm}%")
                    ->orWhereHas('level', function ($q) use ($searchTerm) {
                        $q->where('nama_level', 'LIKE', "%{$searchTerm}%");
                    });
            });
        }

        $users = $query->get();

        try {
            // Calculate user type counts
            $adminCount = $users->where('id_level', LevelModel::where('kode_level', 'ADM')->value('id_level'))->count();
            $dosenCount = $users->where('id_level', LevelModel::where('kode_level', 'DSP')->value('id_level'))->count();
            $mahasiswaCount = $users->where('id_level', LevelModel::where('kode_level', 'MHS')->value('id_level'))->count();

            $totalUsers = $users->count();
            $adminPercentage = $totalUsers > 0 ? round(($adminCount / $totalUsers) * 100, 2) : 0;
            $dosenPercentage = $totalUsers > 0 ? round(($dosenCount / $totalUsers) * 100, 2) : 0;
            $mahasiswaPercentage = $totalUsers > 0 ? round(($mahasiswaCount / $totalUsers) * 100, 2) : 0;

            // Generate file name
            $fileName = 'data_pengguna_' . date('Y-m-d_H-i-s') . '.pdf';

            // Get view content
            $html = view('admin.export_pengguna', [
                'users' => $users,
                'totalUsers' => $totalUsers,
                'adminCount' => $adminCount,
                'dosenCount' => $dosenCount,
                'mahasiswaCount' => $mahasiswaCount,
                'adminPercentage' => $adminPercentage,
                'dosenPercentage' => $dosenPercentage,
                'mahasiswaPercentage' => $mahasiswaPercentage
            ])->render();

            // Set options and generate PDF
            $options = new \Dompdf\Options();
            $options->set('isHtml5ParserEnabled', true);
            $options->set('isRemoteEnabled', true);

            $dompdf = new \Dompdf\Dompdf($options);
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'landscape');
            $dompdf->render();

            // Output PDF (download)
            return response($dompdf->output())
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', "inline; filename=\"$fileName\"");
        } catch (\Exception $e) {
            Log::error('PDF export error: ' . $e->getMessage());
            return back()->with('error', 'Gagal menghasilkan PDF: ' . $e->getMessage());
        }
    }
}
