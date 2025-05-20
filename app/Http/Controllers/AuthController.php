<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserModel;
use App\Models\MahasiswaModel;
use App\Models\ProgramStudi;
use App\Models\LevelModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register()
    {
        $programStudi = \App\Models\ProgramStudi::all();
        return view('auth.register', compact('programStudi'));
    }

    public function postRegister(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'nim' => 'required|string|max:20|unique:mahasiswa,nim',
            'email' => 'required|string|email|max:255|unique:user,email',
            'name' => 'required|string|max:255',
            'study_program' => 'required|string|exists:program_studi,kode_prodi',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Get mahasiswa level
        $mahasiswaLevel = LevelModel::where('kode_level', 'MHS')->first();
        
        if (!$mahasiswaLevel) {
            return back()->withErrors(['level' => 'Level mahasiswa tidak ditemukan'])->withInput();
        }

        try {
            DB::beginTransaction();
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
            
            // Create user account
            $user = UserModel::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'id_level' => $mahasiswaLevel->id_level,
            ]);
            
            // Get program studi ID based on code
            $programStudi = ProgramStudi::where('kode_prodi', $request->study_program)->first();
            
            // Insert mahasiswa
            DB::table('mahasiswa')->insert([
                'id_user' => $user->id_user,
                'nim' => $request->nim,
                'jenis_magang' => null,            
                'id_program_studi' => $programStudi->id_program_studi,
                'id_kompetensi' => null,           
                'preferensi_lokasi' => null,       
                'id_jenis_perusahaan' => null,     
                'created_at' => now(),
                'updated_at' => now()
            ]);

            DB::statement('SET FOREIGN_KEY_CHECKS=1');
            DB::commit();
            
            return redirect()->route('login')->with('success', 'Pendaftaran berhasil! Silakan masuk dengan akun Anda.');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['system' => 'Terjadi kesalahan pada sistem: ' . $e->getMessage()])->withInput();
        }
    }

    public function login()
    {
        if (Auth::check()) { // if already logged in, redirect based on role
            $user = Auth::user();
            $levelCode = $user->level->kode_level ?? '';
            
            if ($levelCode === 'ADM') {
                return redirect()->route('admin.dashboard');
            } else if ($levelCode === 'DSP') {
                return redirect()->route('dosen.dashboard');
            } else if ($levelCode === 'MHS') {
                return redirect()->route('mahasiswa.dashboard');
            }
            
            return redirect('/');
        }
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials, $request->has('remember'))) {
            $request->session()->regenerate();
            
            $user = Auth::user();
            $levelCode = $user->level->kode_level ?? '';
            $redirectUrl = '/';
            
            if ($levelCode === 'ADM') {
                $redirectUrl = route('admin.dashboard');
            } else if ($levelCode === 'DSP') {
                $redirectUrl = route('dosen.dashboard');
            } else if ($levelCode === 'MHS') {
                $redirectUrl = route('mahasiswa.dashboard');
            }
            
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => true,
                    'message' => 'Login Berhasil',
                    'redirect' => $redirectUrl
                ]);
            }
            
            return redirect()->intended($redirectUrl);
        }
        
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'status' => false,
                'message' => 'Email atau password salah'
            ]);
        }
        
        return back()->withErrors([
            'email' => 'Email atau password salah',
        ])->withInput($request->except('password'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
