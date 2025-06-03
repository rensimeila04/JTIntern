<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgramStudiModel;
use Illuminate\Http\Request;

class ProgramStudiController extends Controller
{
    public function index()
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Program Studi', 'url' => '#'],
        ];

        $activeMenu = 'program-studi';

        $programStudi = ProgramStudiModel::all();

        return view('admin.program_studi', [
            'breadcrumb' => $breadcrumb,
            'programStudi' => $programStudi,
            'activeMenu' => $activeMenu
        ]);
    }

    public function detail($id)
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Program Studi', 'url' => route('admin.program_studi')],
            ['label' => 'Detail Program Studi', 'url' => '#'],
        ];

        $activeMenu = 'program-studi';

        $programStudi = ProgramStudiModel::findOrFail($id);

        return view('admin.detail_program_studi', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'programStudi' => $programStudi,
        ]);
    }

    public function create()
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Program Studi', 'url' => route('admin.program_studi')],
            ['label' => 'Tambah Program Studi', 'url' => '#'],
        ];

        $activeMenu = 'program-studi';

        return view('admin.tambah_program_studi', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_prodi' => 'required|string|max:50|unique:program_studi,kode_prodi',
            'nama_prodi' => 'required|string|max:255',
        ]);

        $programStudi = ProgramStudiModel::create([
            'kode_prodi' => $request->kode_prodi,
            'nama_prodi' => $request->nama_prodi,
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => "Program Studi berhasil ditambahkan.",
                'prodi_name' => $request->nama_prodi
            ]);
        }

        return redirect()->route('admin.program_studi.create')
            ->with('success', true)
            ->with('prodi_name', $request->nama_prodi)
            ->with('message', 'Program Studi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Program Studi', 'url' => route('admin.program_studi')],
            ['label' => 'Edit Program Studi', 'url' => '#'],
        ];

        $activeMenu = 'program-studi';

        $programStudi = ProgramStudiModel::findOrFail($id);

        return view('admin.edit_program_studi', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'programStudi' => $programStudi,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_prodi' => 'required|string|max:50|unique:program_studi,kode_prodi,' . $id . ',id_program_studi',
            'nama_prodi' => 'required|string|max:255',
        ]);

        $programStudi = ProgramStudiModel::findOrFail($id);
        $programStudi->update([
            'kode_prodi' => $request->kode_prodi,
            'nama_prodi' => $request->nama_prodi,
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Program studi berhasil diperbarui.',
                'prodi_name' => $request->nama_prodi
            ]);
        }

        return redirect()->route('admin.program_studi')
            ->with('success', true)
            ->with('prodi_name', $request->nama_prodi)
            ->with('message', 'Program studi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        try {
            $programStudi = ProgramStudiModel::findOrFail($id);
            $nama = $programStudi->nama_program_studi;
            $programStudi->delete();

            return response()->json([
                'success' => true,
                'message' => "Program Studi '{$nama}' berhasil dihapus."
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
