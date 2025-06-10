<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PerusahaanMitraModel;
use App\Models\JenisPerusahaanModel;
use App\Models\FasilitasModel;
use App\Models\FasilitasPerusahaanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class PerusahaanController extends Controller
{
    public function index(Request $request)
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Perusahaan Mitra', 'url' => '#'],
        ];

        $activeMenu = 'perusahaan_mitra';
        
        // Query builder untuk perusahaan mitra
        $query = PerusahaanMitraModel::with('jenisPerusahaan');
        
        // Filter berdasarkan jenis perusahaan
        if ($request->filled('jenis_perusahaan') && $request->jenis_perusahaan != 'all') {
            $query->where('id_jenis_perusahaan', $request->jenis_perusahaan);
        }
        
        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('nama_perusahaan_mitra', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('bidang_industri', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('alamat', 'LIKE', "%{$searchTerm}%")
                  ->orWhereHas('jenisPerusahaan', function($q) use ($searchTerm) {
                      $q->where('nama_jenis_perusahaan', 'LIKE', "%{$searchTerm}%");
                  });
            });
        }
        
        $perusahaanMitra = $query->paginate(10)->appends($request->query());
        $jenisPerusahaan = JenisPerusahaanModel::all();
        
        return view('admin.perusahaan', [
            'breadcrumb' => $breadcrumb,
            'perusahaanMitra' => $perusahaanMitra,
            'jenisPerusahaan' => $jenisPerusahaan,
            'activeMenu' => $activeMenu,
            'currentFilter' => $request->jenis_perusahaan ?? 'all',
            'currentSearch' => $request->search ?? ''
        ]);
    }

    public function detail($id)
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Perusahaan Mitra', 'url' => route('admin.perusahaan')],
            ['label' => 'Detail', 'url' => '#'],
        ];

        $activeMenu = 'perusahaan_mitra';
        
        // Ambil data perusahaan dengan relasi
        $perusahaan = PerusahaanMitraModel::with([
            'jenisPerusahaan', 
            'fasilitasPerusahaan.fasilitas',
            'lowongan' => function($query) {
                $query->with(['kompetensi', 'periodeMagang'])
                      ->orderBy('created_at', 'desc');
            }
        ])->findOrFail($id);
        
        return view('admin.detail_perusahaan_mitra', [
            'perusahaan' => $perusahaan,
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu
        ]);
    }

    public function create()
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Perusahaan Mitra', 'url' => route('admin.perusahaan')],
            ['label' => 'Tambah', 'url' => '#'],
        ];

        $activeMenu = 'perusahaan_mitra';
        $jenisPerusahaan = JenisPerusahaanModel::all();
        $fasilitas = FasilitasModel::all();
        
        return view('admin.tambah_perusahaan', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'jenisPerusahaan' => $jenisPerusahaan,
            'fasilitas' => $fasilitas
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'email_perusahaan' => 'required|email|max:255',
            'nomor_telepon' => 'required|string|max:20',
            'alamat_perusahaan' => 'required|string',
            'jenis_perusahaan_id' => 'required|exists:jenis_perusahaan,id_jenis_perusahaan',
            'bidang_industri' => 'required|string|max:255',
            'tentang_perusahaan' => 'nullable|string',
            'logo_perusahaan' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'alamat_latitude' => 'nullable|numeric',
            'alamat_longitude' => 'nullable|numeric',
            'fasilitas' => 'nullable|array',
            'fasilitas.*' => 'exists:fasilitas,id_fasilitas',
        ]);

        try {
            // Handle logo upload
            $logoPath = null;
            
            if ($request->hasFile('logo_perusahaan')) {
                // Create custom filename with timestamp
                $file = $request->file('logo_perusahaan');
                $filename = time() . '_' . $file->getClientOriginalName();
                
                // Store in public/storage/logo_perusahaan directory
                $logoPath = $file->storeAs('logo_perusahaan', $filename, 'public');
            }

            // Map form fields to database fields
            $data = [
                'nama_perusahaan_mitra' => $validated['nama_perusahaan'],
                'email' => $validated['email_perusahaan'],
                'telepon' => $validated['nomor_telepon'],
                'alamat' => $validated['alamat_perusahaan'],
                'id_jenis_perusahaan' => $validated['jenis_perusahaan_id'],
                'bidang_industri' => $validated['bidang_industri'],
                'tentang' => $validated['tentang_perusahaan'] ?? null,
                'logo' => $logoPath,
                'latitude' => $validated['alamat_latitude'] ?? null,
                'longitude' => $validated['alamat_longitude'] ?? null,
            ];

            // Create the company
            $perusahaan = PerusahaanMitraModel::create($data);
            
            // Save facilities if selected
            if (!empty($validated['fasilitas'])) {
                foreach ($validated['fasilitas'] as $fasilitasId) {
                    FasilitasPerusahaanModel::create([
                        'id_perusahaan_mitra' => $perusahaan->id_perusahaan_mitra,
                        'id_fasilitas' => $fasilitasId,
                    ]);
                }
            }
            
            return redirect()->route('admin.perusahaan.create')
                ->with([
                    'success' => true,
                    'company_name' => $validated['nama_perusahaan'],
                    'message' => 'Perusahaan mitra berhasil ditambahkan'
                ]);

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Perusahaan Mitra', 'url' => route('admin.perusahaan')],
            ['label' => 'Edit', 'url' => '#'],
        ];

        $activeMenu = 'perusahaan_mitra';
        
        // Ambil data perusahaan dengan relasi fasilitas
        $perusahaan = PerusahaanMitraModel::with('fasilitasPerusahaan')->findOrFail($id);
        $jenisPerusahaan = JenisPerusahaanModel::all();
        $fasilitas = FasilitasModel::all();
        
        // Ambil ID fasilitas yang sudah dipilih
        $selectedFasilitas = $perusahaan->fasilitasPerusahaan->pluck('id_fasilitas')->toArray();
        
        return view('admin.edit_perusahaan', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'perusahaan' => $perusahaan,
            'jenisPerusahaan' => $jenisPerusahaan,
            'fasilitas' => $fasilitas,
            'selectedFasilitas' => $selectedFasilitas
        ]);
    }

    public function update(Request $request, $id)
    {
        $perusahaan = PerusahaanMitraModel::findOrFail($id);
        
        $validated = $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'email_perusahaan' => 'required|email|max:255',
            'nomor_telepon' => 'required|string|max:20',
            'alamat_perusahaan' => 'required|string',
            'jenis_perusahaan_id' => 'required|exists:jenis_perusahaan,id_jenis_perusahaan',
            'bidang_industri' => 'required|string|max:255',
            'tentang_perusahaan' => 'nullable|string',
            'logo_perusahaan' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'alamat_latitude' => 'nullable|numeric',
            'alamat_longitude' => 'nullable|numeric',
            'fasilitas' => 'nullable|array',
            'fasilitas.*' => 'exists:fasilitas,id_fasilitas',
        ]);

        try {
            // Handle logo upload
            $logoPath = $perusahaan->logo; // Keep existing logo by default
            
            if ($request->hasFile('logo_perusahaan')) {
                // Delete old logo if it exists and is not a placeholder
                if ($perusahaan->logo && !str_starts_with($perusahaan->logo, 'images/')) {
                    Storage::disk('public')->delete($perusahaan->logo);
                }
                
                // Upload new logo
                $file = $request->file('logo_perusahaan');
                $filename = time() . '_' . $file->getClientOriginalName();
                $logoPath = $file->storeAs('logo_perusahaan', $filename, 'public');
            }

            // Map form fields to database fields
            $data = [
                'nama_perusahaan_mitra' => $validated['nama_perusahaan'],
                'email' => $validated['email_perusahaan'],
                'telepon' => $validated['nomor_telepon'],
                'alamat' => $validated['alamat_perusahaan'],
                'id_jenis_perusahaan' => $validated['jenis_perusahaan_id'],
                'bidang_industri' => $validated['bidang_industri'],
                'tentang' => $validated['tentang_perusahaan'] ?? null,
                'logo' => $logoPath,
                'latitude' => $validated['alamat_latitude'] ?? null,
                'longitude' => $validated['alamat_longitude'] ?? null,
            ];

            // Update the company
            $perusahaan->update($data);
            
            // Update facilities
            // Delete existing facilities
            FasilitasPerusahaanModel::where('id_perusahaan_mitra', $id)->delete();
            
            // Save new facilities if selected
            if (!empty($validated['fasilitas'])) {
                foreach ($validated['fasilitas'] as $fasilitasId) {
                    FasilitasPerusahaanModel::create([
                        'id_perusahaan_mitra' => $id,
                        'id_fasilitas' => $fasilitasId,
                    ]);
                }
            }
            
            // Redirect back to edit page with success message
            return redirect()->route('admin.perusahaan.edit', $id)
                ->with([
                    'success' => true,
                    'company_name' => $validated['nama_perusahaan'],
                    'message' => 'Data perusahaan ' . $validated['nama_perusahaan'] . ' berhasil diperbarui'
                ]);

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $perusahaan = PerusahaanMitraModel::findOrFail($id);
            
            // Check if company has active internships/lowongan
            if ($perusahaan->lowongan()->exists()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Perusahaan tidak dapat dihapus karena masih memiliki lowongan aktif'
                ], 422);
            }
            
            // Delete associated facilities first
            FasilitasPerusahaanModel::where('id_perusahaan_mitra', $id)->delete();
            
            // Delete logo file if exists and is not a placeholder
            if ($perusahaan->logo && !str_starts_with($perusahaan->logo, 'images/')) {
                Storage::disk('public')->delete($perusahaan->logo);
            }
            
            // Delete the company
            $perusahaan->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Perusahaan mitra berhasil dihapus'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus perusahaan: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Show import form for company data
     */
    public function importForm()
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Perusahaan Mitra', 'url' => route('admin.perusahaan')],
            ['label' => 'Import Perusahaan', 'url' => '#'],
        ];

        $activeMenu = 'perusahaan_mitra';

        return view('admin.import_perusahaan_mitra', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu
        ]);
    }

    /**
     * Download Excel template for company import
     */
    public function downloadTemplate()
    {
        // Path ke file template manual
        $templatePath = public_path('templates/template_import_perusahaan.xlsx');

        // Periksa apakah file template ada
        if (!file_exists($templatePath)) {
            return back()->with('error', 'File template tidak ditemukan. Silakan hubungi administrator.');
        }

        // Return file sebagai download
        return response()->download($templatePath, 'template_import_perusahaan.xlsx', [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }

    /**
     * Process the imported Excel file for companies
     */
    public function importStore(Request $request)
    {
        // Validasi untuk memastikan CSV/Excel diterima
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
            
            return redirect()->route('admin.perusahaan.import')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Proses file yang diupload
            $file = $request->file('excel_file');
            $extension = strtolower($file->getClientOriginalExtension());
            
            $rows = 0; // Jumlah baris yang berhasil diimport
            $errors = [];

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
                
                return redirect()->route('admin.perusahaan.import')
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

            return redirect()->route('admin.perusahaan.import')
                ->with('success', 'Data perusahaan berhasil diimport')
                ->with('count', $rows);
                
        } catch (\Exception $e) {
            Log::error('Error importing companies:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->route('admin.perusahaan.import')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Process CSV file for company import
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
                // Buat array data perusahaan dari baris CSV
                $companyData = [
                    'nama_perusahaan_mitra' => $data[0] ?? '',
                    'email' => $data[1] ?? '',
                    'telepon' => $data[2] ?? '',
                    'alamat' => $data[3] ?? '',
                    'id_jenis_perusahaan' => $data[4] ?? '',
                    'bidang_industri' => $data[5] ?? '',
                    'tentang' => $data[6] ?? '',
                    'logo' => null,
                    'latitude' => $data[7] ?? null,
                    'longitude' => $data[8] ?? null,
                ];

                // Simpan data perusahaan
                $this->saveCompany($companyData, $rows, $errors);
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
                // Buat array data perusahaan dari baris Excel
                $companyData = [
                    'nama_perusahaan_mitra' => $row[0] ?? '',
                    'email' => $row[1] ?? '',
                    'telepon' => $row[2] ?? '',
                    'alamat' => $row[3] ?? '',
                    'id_jenis_perusahaan' => $row[4] ?? '',
                    'bidang_industri' => $row[5] ?? '',
                    'tentang' => $row[6] ?? '',
                    'logo' => null,
                    'latitude' => $row[7] ?? null,
                    'longitude' => $row[8] ?? null,
                ];

                // Simpan data perusahaan
                $this->saveCompany($companyData, $rows, $errors);
            } catch (\Exception $e) {
                $errors[] = "Error baris " . ($i + 1) . ": " . $e->getMessage();
            }
        }
    }

    /**
     * Save company data to database
     */
    private function saveCompany($companyData, &$rows, &$errors)
    {
        // Validasi data
        if (empty($companyData['nama_perusahaan_mitra'])) {
            throw new \Exception('Nama perusahaan tidak boleh kosong');
        }

        if (empty($companyData['email'])) {
            throw new \Exception('Email tidak boleh kosong');
        }

        if (!filter_var($companyData['email'], FILTER_VALIDATE_EMAIL)) {
            throw new \Exception('Format email tidak valid');
        }

        if (empty($companyData['telepon'])) {
            throw new \Exception('Nomor telepon tidak boleh kosong');
        }

        if (empty($companyData['alamat'])) {
            throw new \Exception('Alamat tidak boleh kosong');
        }

        if (empty($companyData['id_jenis_perusahaan'])) {
            throw new \Exception('Jenis perusahaan tidak boleh kosong');
        }

        // Cek jenis perusahaan valid
        $jenisPerusahaan = JenisPerusahaanModel::find($companyData['id_jenis_perusahaan']);
        if (!$jenisPerusahaan) {
            throw new \Exception('Jenis perusahaan tidak valid');
        }

        if (empty($companyData['bidang_industri'])) {
            throw new \Exception('Bidang industri tidak boleh kosong');
        }

        // Buat perusahaan baru
        $perusahaan = new PerusahaanMitraModel($companyData);
        $perusahaan->save();

        $rows++;
    }

    /**
     * Export company data to PDF
     */
    public function export(Request $request)
    {
        // Query builder untuk perusahaan mitra
        $query = PerusahaanMitraModel::with('jenisPerusahaan');
        
        // Filter berdasarkan jenis perusahaan
        if ($request->filled('jenis_perusahaan') && $request->jenis_perusahaan != 'all') {
            $query->where('id_jenis_perusahaan', $request->jenis_perusahaan);
        }
        
        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('nama_perusahaan_mitra', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('bidang_industri', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('alamat', 'LIKE', "%{$searchTerm}%")
                  ->orWhereHas('jenisPerusahaan', function($q) use ($searchTerm) {
                      $q->where('nama_jenis_perusahaan', 'LIKE', "%{$searchTerm}%");
                  });
            });
        }

        $perusahaanMitra = $query->get();

        try {
            // Calculate company type counts
            $jenisPerusahaan = JenisPerusahaanModel::all();
            $jenisPerusahaanCounts = [];
            
            foreach ($jenisPerusahaan as $jenis) {
                $count = $perusahaanMitra->where('id_jenis_perusahaan', $jenis->id_jenis_perusahaan)->count();
                $percentage = $perusahaanMitra->count() > 0 ? round(($count / $perusahaanMitra->count()) * 100, 2) : 0;
                
                $jenisPerusahaanCounts[] = [
                    'nama' => $jenis->nama_jenis_perusahaan,
                    'count' => $count,
                    'percentage' => $percentage
                ];
            }

            // Generate file name
            $fileName = 'data_perusahaan_mitra_' . date('Y-m-d_H-i-s') . '.pdf';

            // Get view content
            $html = view('admin.export_perusahaan_mitra', [
                'perusahaanMitra' => $perusahaanMitra,
                'totalPerusahaan' => $perusahaanMitra->count(),
                'jenisPerusahaanCounts' => $jenisPerusahaanCounts
            ])->render();

            // Set options and generate PDF
            $options = new \Dompdf\Options();
            $options->set('isHtml5ParserEnabled', true);
            $options->set('isRemoteEnabled', true);

            $dompdf = new \Dompdf\Dompdf($options);
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'landscape');
            $dompdf->render();

            // Output PDF (inline view)
            return response($dompdf->output())
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', "inline; filename=\"$fileName\"");
        } catch (\Exception $e) {
            Log::error('PDF export error: ' . $e->getMessage());
            return back()->with('error', 'Gagal menghasilkan PDF: ' . $e->getMessage());
        }
    }
}
