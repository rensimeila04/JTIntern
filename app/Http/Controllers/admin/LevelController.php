<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LevelModel;
use Illuminate\Support\Facades\Validator;

class LevelController extends Controller
{
    public function index()
    {
        $breadcrumb = [
            ['label' => 'Home', 'url' => route('landing')],
            ['label' => 'Level Pengguna', 'url' => '#'],
        ];

        $activeMenu = 'level-pengguna';
        $levels = LevelModel::all();

        return view('admin.level_pengguna', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'levels' => $levels
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_level' => 'required|string|max:10|unique:level,kode_level',
            'nama_level' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }
            return redirect()->route('admin.level')
                ->withErrors($validator)
                ->withInput();
        }

        $level = LevelModel::create([
            'kode_level' => strtoupper($request->kode_level),
            'nama_level' => $request->nama_level
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Data Level Pengguna berhasil ditambahkan.',
                'data' => $level
            ]);
        }

        return redirect()->route('admin.level')
            ->with('success', 'Data Level Pengguna berhasil ditambahkan.');
    }

    public function detail($id, Request $request)
    {
        $level = LevelModel::findOrFail($id);

        // Jika request AJAX (untuk modal), balas JSON saja
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'data' => [
                    'id_level'   => $level->id_level,
                    'kode_level' => $level->kode_level,
                    'nama_level' => $level->nama_level,
                ]
            ]);
        }

        // Jika bukan AJAX, bisa redirect atau tampilkan error
        return abort(404);
    }
}

