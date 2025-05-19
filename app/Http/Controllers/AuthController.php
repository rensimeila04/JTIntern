<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserModel;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register()
    {
        $programStudi = \App\Models\ProgramStudi::all();
        return view('auth.register', compact('programStudi'));
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
