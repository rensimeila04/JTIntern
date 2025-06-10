<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PerusahaanMitraModel;
use App\Models\PeriodeMagangModel;
use App\Models\KompetensiModel;
use App\Models\LowonganModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class LowonganController extends Controller
{
    public function index(Request $request)
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Lowongan', 'url' => '#'],
        ];

        $activeMenu = 'lowongan';

        // Query builder untuk lowongan dengan relasi
        $query = LowonganModel::with(['perusahaanMitra', 'periodeMagang', 'kompetensi']);

        // Filter berdasarkan periode
        if ($request->filled('periode') && $request->periode != 'all') {
            $query->where('id_periode_magang', $request->periode);
        }

        // Filter berdasarkan perusahaan
        if ($request->filled('perusahaan') && $request->perusahaan != 'all') {
            $query->where('id_perusahaan_mitra', $request->perusahaan);
        }

        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('judul_lowongan', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('deskripsi', 'LIKE', "%{$searchTerm}%")
                  ->orWhereHas('perusahaanMitra', function($q) use ($searchTerm) {
                      $q->where('nama_perusahaan_mitra', 'LIKE', "%{$searchTerm}%");
                  })
                  ->orWhereHas('kompetensi', function($q) use ($searchTerm) {
                      $q->where('nama_kompetensi', 'LIKE', "%{$searchTerm}%");
                  });
            });
        }

        $lowongan = $query->orderBy('created_at', 'desc')->paginate(5)->appends($request->query());
        
        // Data untuk dropdown filter
        $periodeList = PeriodeMagangModel::all();
        $perusahaanList = PerusahaanMitraModel::all();

        $data = [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'lowongan' => $lowongan,
            'periodeList' => $periodeList,
            'perusahaanList' => $perusahaanList,
            'currentPeriode' => $request->periode ?? 'all',
            'currentPerusahaan' => $request->perusahaan ?? 'all',
            'currentSearch' => $request->search ?? ''
        ];

        // Check if this is an AJAX request for live search
        if ($request->ajax() || $request->header('X-Requested-With') === 'XMLHttpRequest') {
            // Return only the lowongan container content for AJAX requests
            return view('admin.lowongan', $data);
        }

        return view('admin.lowongan', $data);
    }

    public function detailLowongan($id)
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Lowongan', 'url' => route('admin.lowongan')],
            ['label' => 'Detail Lowongan', 'url' => '#'],
        ];

        $activeMenu = 'lowongan';

        // Ambil data lowongan dengan relasi
        $lowongan = LowonganModel::with(['perusahaanMitra', 'periodeMagang', 'kompetensi'])
                                 ->findOrFail($id);

        return view('admin.detail_lowongan', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'lowongan' => $lowongan
        ]);
    }

    public function tambahLowongan()
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Lowongan', 'url' => route('admin.lowongan')],
            ['label' => 'Tambah Lowongan', 'url' => '#'],
        ];

        $activeMenu = 'lowongan';

        $perusahaan = PerusahaanMitraModel::all();
        $periode = PeriodeMagangModel::all();
        $kompetensi = KompetensiModel::all();

        return view('admin.tambah_lowongan', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'perusahaan' => $perusahaan,
            'periode' => $periode,
            'kompetensi' => $kompetensi,
        ]);
    }

    public function storeLowongan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_perusahaan_mitra' => 'required|exists:perusahaan_mitra,id_perusahaan_mitra',
            'id_periode_magang' => 'required|exists:periode_magang,id_periode_magang',
            'judul_lowongan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'persyaratan' => 'required|string',
            'id_kompetensi' => 'required|exists:kompetensi,id_kompetensi',
            'jenis_magang' => 'required|in:wfo,remote,hybrid',
            'deadline_pendaftaran' => 'nullable|date',
            'test' => 'nullable|boolean',
            'informasi_test' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        LowonganModel::create([
            'id_perusahaan_mitra' => $request->id_perusahaan_mitra,
            'id_periode_magang' => $request->id_periode_magang,
            'judul_lowongan' => $request->judul_lowongan,
            'deskripsi' => $request->deskripsi,
            'persyaratan' => $request->persyaratan,
            'id_kompetensi' => $request->id_kompetensi,
            'jenis_magang' => $request->jenis_magang,
            'status_pendaftaran' => true,
            'deadline_pendaftaran' => $request->deadline_pendaftaran,
            'test' => $request->test ? true : false,
            'informasi_test' => $request->informasi_test,
        ]);

        return redirect()->route('admin.lowongan.tambah')->with([
            'success' => true,
            'judul_lowongan' => $request->judul_lowongan
        ]);
    }

    public function editLowongan($id)
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Lowongan', 'url' => route('admin.lowongan')],
            ['label' => 'Edit Lowongan', 'url' => '#'],
        ];

        $activeMenu = 'lowongan';

        // Get the lowongan data
        $lowongan = LowonganModel::with(['perusahaanMitra', 'periodeMagang', 'kompetensi'])
                                 ->findOrFail($id);

        // Get all data for dropdowns
        $perusahaan = PerusahaanMitraModel::all();
        $periode = PeriodeMagangModel::all();
        $kompetensi = KompetensiModel::all();

        return view('admin.edit_lowongan', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'lowongan' => $lowongan,
            'perusahaan' => $perusahaan,
            'periode' => $periode,
            'kompetensi' => $kompetensi,
        ]);
    }

    public function updateLowongan(Request $request, $id)
    {
        $lowongan = LowonganModel::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'id_perusahaan_mitra' => 'required|exists:perusahaan_mitra,id_perusahaan_mitra',
            'id_periode_magang' => 'required|exists:periode_magang,id_periode_magang',
            'judul_lowongan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'persyaratan' => 'required|string',
            'id_kompetensi' => 'required|exists:kompetensi,id_kompetensi',
            'jenis_magang' => 'required|in:wfo,remote,hybrid',
            'deadline_pendaftaran' => 'nullable|date',
            'test' => 'nullable|boolean',
            'informasi_test' => 'nullable|string',
            'status_pendaftaran' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $lowongan->update([
            'id_perusahaan_mitra' => $request->id_perusahaan_mitra,
            'id_periode_magang' => $request->id_periode_magang,
            'judul_lowongan' => $request->judul_lowongan,
            'deskripsi' => $request->deskripsi,
            'persyaratan' => $request->persyaratan,
            'id_kompetensi' => $request->id_kompetensi,
            'jenis_magang' => $request->jenis_magang,
            'status_pendaftaran' => $request->status_pendaftaran ? true : false,
            'deadline_pendaftaran' => $request->deadline_pendaftaran,
            'test' => $request->test ? true : false,
            'informasi_test' => $request->informasi_test,
        ]);

        return redirect()->route('admin.lowongan.edit', $id)->with([
            'success' => true,
            'judul_lowongan' => $request->judul_lowongan,
            'message' => 'Data lowongan berhasil diperbarui'
        ]);
    }

    public function destroyLowongan($id)
    {
        try {
            $lowongan = LowonganModel::findOrFail($id);
            
            // Check if lowongan has active applications/magang
            // Add null check for relationship
            if (method_exists($lowongan, 'magang') && $lowongan->magang()->exists()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Lowongan tidak dapat dihapus karena sudah memiliki pendaftar'
                ], 422);
            }
            
            $judulLowongan = $lowongan->judul_lowongan;
            
            // Add null check for relationship
            $perusahaanNama = optional($lowongan->perusahaanMitra)->nama_perusahaan_mitra ?? 'Unknown';
            
            // Delete the lowongan
            $lowongan->delete();
            
            return response()->json([
                'success' => true,
                'message' => "Lowongan '{$judulLowongan}' dari {$perusahaanNama} berhasil dihapus"
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error deleting lowongan: ' . $e->getMessage(), [
                'id' => $id,
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus lowongan'
            ], 500);
        }
    }

    /**
     * Show import form for job openings
     */
    public function importForm()
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Lowongan', 'url' => route('admin.lowongan')],
            ['label' => 'Import Lowongan', 'url' => '#'],
        ];

        $activeMenu = 'lowongan';

        return view('admin.import_lowongan', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu
        ]);
    }

    /**
     * Download Excel template for job openings import
     */
    public function downloadTemplate()
    {
        // Path ke file template manual
        $templatePath = public_path('templates/template_import_lowongan.xlsx');

        // Periksa apakah file template ada
        if (!file_exists($templatePath)) {
            return back()->with('error', 'File template tidak ditemukan. Silakan hubungi administrator.');
        }

        // Return file sebagai download
        return response()->download($templatePath, 'template_import_lowongan.xlsx', [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }

    /**
     * Process the imported Excel file for job openings
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
            
            return redirect()->route('admin.lowongan.import')
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
                
                return redirect()->route('admin.lowongan.import')
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

            return redirect()->route('admin.lowongan.import')
                ->with('success', 'Data lowongan berhasil diimport')
                ->with('count', $rows);
                
        } catch (\Exception $e) {
            Log::error('Error importing job openings:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->route('admin.lowongan.import')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Process CSV file for job openings import
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
                // Buat array data lowongan dari baris CSV
                $jobData = [
                    'id_perusahaan_mitra' => $data[0] ?? '',
                    'id_periode_magang' => $data[1] ?? '',
                    'judul_lowongan' => $data[2] ?? '',
                    'deskripsi' => $data[3] ?? '',
                    'persyaratan' => $data[4] ?? '',
                    'id_kompetensi' => $data[5] ?? '',
                    'jenis_magang' => $data[6] ?? '',
                    'deadline_pendaftaran' => $data[7] ?? null,
                    'test' => $data[8] ?? 0,
                    'informasi_test' => $data[9] ?? '',
                    'status_pendaftaran' => $data[10] ?? 1,
                ];

                // Simpan data lowongan
                $this->saveLowongan($jobData, $rows, $errors);
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
                // Buat array data lowongan dari baris Excel
                $jobData = [
                    'id_perusahaan_mitra' => $row[0] ?? '',
                    'id_periode_magang' => $row[1] ?? '',
                    'judul_lowongan' => $row[2] ?? '',
                    'deskripsi' => $row[3] ?? '',
                    'persyaratan' => $row[4] ?? '',
                    'id_kompetensi' => $row[5] ?? '',
                    'jenis_magang' => $row[6] ?? '',
                    'deadline_pendaftaran' => $row[7] ?? null,
                    'test' => $row[8] ?? 0,
                    'informasi_test' => $row[9] ?? '',
                    'status_pendaftaran' => $row[10] ?? 1,
                ];

                // Simpan data lowongan
                $this->saveLowongan($jobData, $rows, $errors);
            } catch (\Exception $e) {
                $errors[] = "Error baris " . ($i + 1) . ": " . $e->getMessage();
            }
        }
    }

    /**
     * Save job opening data to database
     */
    private function saveLowongan($jobData, &$rows, &$errors)
    {
        // Validasi data
        if (empty($jobData['id_perusahaan_mitra'])) {
            throw new \Exception('ID perusahaan mitra tidak boleh kosong');
        }

        // Cek perusahaan mitra valid
        $perusahaan = PerusahaanMitraModel::find($jobData['id_perusahaan_mitra']);
        if (!$perusahaan) {
            throw new \Exception('Perusahaan mitra dengan ID tersebut tidak ditemukan');
        }

        if (empty($jobData['id_periode_magang'])) {
            throw new \Exception('ID periode magang tidak boleh kosong');
        }

        // Cek periode magang valid
        $periode = PeriodeMagangModel::find($jobData['id_periode_magang']);
        if (!$periode) {
            throw new \Exception('Periode magang dengan ID tersebut tidak ditemukan');
        }

        if (empty($jobData['judul_lowongan'])) {
            throw new \Exception('Judul lowongan tidak boleh kosong');
        }

        if (empty($jobData['deskripsi'])) {
            throw new \Exception('Deskripsi lowongan tidak boleh kosong');
        }

        if (empty($jobData['persyaratan'])) {
            throw new \Exception('Persyaratan lowongan tidak boleh kosong');
        }

        if (empty($jobData['id_kompetensi'])) {
            throw new \Exception('ID kompetensi tidak boleh kosong');
        }

        // Cek kompetensi valid
        $kompetensi = KompetensiModel::find($jobData['id_kompetensi']);
        if (!$kompetensi) {
            throw new \Exception('Kompetensi dengan ID tersebut tidak ditemukan');
        }

        if (empty($jobData['jenis_magang'])) {
            throw new \Exception('Jenis magang tidak boleh kosong');
        }

        // Validasi jenis magang
        if (!in_array(strtolower($jobData['jenis_magang']), ['wfo', 'remote', 'hybrid'])) {
            throw new \Exception('Jenis magang harus salah satu dari: wfo, remote, hybrid');
        }

        // Validasi tanggal deadline jika ada
        if (!empty($jobData['deadline_pendaftaran'])) {
            try {
                $deadline = new \DateTime($jobData['deadline_pendaftaran']);
                $jobData['deadline_pendaftaran'] = $deadline->format('Y-m-d');
            } catch (\Exception $e) {
                throw new \Exception('Format tanggal deadline pendaftaran tidak valid');
            }
        }

        // Convert test to boolean
        $jobData['test'] = filter_var($jobData['test'], FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
        
        // Convert status_pendaftaran to boolean if provided
        $jobData['status_pendaftaran'] = filter_var($jobData['status_pendaftaran'], FILTER_VALIDATE_BOOLEAN) ? 1 : 0;

        // Buat lowongan baru
        $lowongan = new LowonganModel();
        $lowongan->id_perusahaan_mitra = $jobData['id_perusahaan_mitra'];
        $lowongan->id_periode_magang = $jobData['id_periode_magang']; 
        $lowongan->judul_lowongan = $jobData['judul_lowongan'];
        $lowongan->deskripsi = $jobData['deskripsi'];
        $lowongan->persyaratan = $jobData['persyaratan'];
        $lowongan->id_kompetensi = $jobData['id_kompetensi'];
        $lowongan->jenis_magang = strtolower($jobData['jenis_magang']);
        $lowongan->deadline_pendaftaran = $jobData['deadline_pendaftaran'];
        $lowongan->test = $jobData['test'];
        $lowongan->informasi_test = $jobData['informasi_test'];
        $lowongan->status_pendaftaran = $jobData['status_pendaftaran'];
        
        $lowongan->save();
        $rows++;
    }

    /**
     * Export job openings data to PDF
     */
    public function export(Request $request)
    {
        // Query builder for lowongan
        $query = LowonganModel::with(['perusahaanMitra', 'periodeMagang', 'kompetensi']);
        
        // Filter berdasarkan periode
        if ($request->filled('periode') && $request->periode != 'all') {
            $query->where('id_periode_magang', $request->periode);
        }

        // Filter berdasarkan perusahaan
        if ($request->filled('perusahaan') && $request->perusahaan != 'all') {
            $query->where('id_perusahaan_mitra', $request->perusahaan);
        }
        
        // Search functionality
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('judul_lowongan', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('deskripsi', 'LIKE', "%{$searchTerm}%")
                  ->orWhereHas('perusahaanMitra', function($q) use ($searchTerm) {
                      $q->where('nama_perusahaan_mitra', 'LIKE', "%{$searchTerm}%");
                  })
                  ->orWhereHas('kompetensi', function($q) use ($searchTerm) {
                      $q->where('nama_kompetensi', 'LIKE', "%{$searchTerm}%");
                  });
            });
        }

        $lowongan = $query->get();

        try {
            // Calculate job statistics
            $totalLowongan = $lowongan->count();
            
            // Count by magang type
            $wfoCount = $lowongan->where('jenis_magang', 'wfo')->count();
            $remoteCount = $lowongan->where('jenis_magang', 'remote')->count();
            $hybridCount = $lowongan->where('jenis_magang', 'hybrid')->count();
            
            $wfoPercentage = $totalLowongan > 0 ? round(($wfoCount / $totalLowongan) * 100, 2) : 0;
            $remotePercentage = $totalLowongan > 0 ? round(($remoteCount / $totalLowongan) * 100, 2) : 0;
            $hybridPercentage = $totalLowongan > 0 ? round(($hybridCount / $totalLowongan) * 100, 2) : 0;
            
            // Count by status
            $activeCount = $lowongan->where('status_pendaftaran', 1)->count();
            $inactiveCount = $lowongan->where('status_pendaftaran', 0)->count();
            
            $activePercentage = $totalLowongan > 0 ? round(($activeCount / $totalLowongan) * 100, 2) : 0;
            $inactivePercentage = $totalLowongan > 0 ? round(($inactiveCount / $totalLowongan) * 100, 2) : 0;

            // Generate file name
            $fileName = 'data_lowongan_' . date('Y-m-d_H-i-s') . '.pdf';

            // Get view content
            $html = view('admin.export_lowongan', [
                'lowongan' => $lowongan,
                'totalLowongan' => $totalLowongan,
                'wfoCount' => $wfoCount,
                'remoteCount' => $remoteCount,
                'hybridCount' => $hybridCount,
                'wfoPercentage' => $wfoPercentage,
                'remotePercentage' => $remotePercentage,
                'hybridPercentage' => $hybridPercentage,
                'activeCount' => $activeCount,
                'inactiveCount' => $inactiveCount,
                'activePercentage' => $activePercentage,
                'inactivePercentage' => $inactivePercentage
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
