<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PerusahaanMitraModel;
use App\Models\PeriodeMagangModel;
use App\Models\KompetensiModel;
use App\Models\LowonganModel;
use Illuminate\Support\Facades\Validator;

class LowonganController extends Controller
{
    public function index()
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Lowongan', 'url' => '#'],
        ];

        $activeMenu = 'lowongan';

        return view('admin.lowongan', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu
        ]);
    }

    public function detailLowongan($id)
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Lowongan', 'url' => '#'],
            ['label' => 'Detail Lowongan', 'url' => '#'],
        ];

        $activeMenu = 'lowongan';

        return view('admin.detail_lowongan', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'id' => $id
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

        return redirect()->route('admin.lowongan')->with('success', 'Lowongan berhasil ditambahkan!');
    }

    public function editLowongan($id)
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Lowongan', 'url' => route('admin.lowongan')],
            ['label' => 'Edit Lowongan', 'url' => '#'],
        ];

        $activeMenu = 'lowongan';

        return view('admin.edit_lowongan', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'id' => $id
        ]);
    }
}
