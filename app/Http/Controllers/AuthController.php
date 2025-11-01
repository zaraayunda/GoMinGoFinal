<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Show login form
     */
    public function showLoginForm()
    {
        return view('Login.login');
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'email' => ['required', 'email', 'max:100'],
            'password' => ['required', 'string', 'min:1'],
        ], [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid. Contoh: nama@email.com',
            'email.max' => 'Email maksimal 100 karakter',
            'password.required' => 'Password harus diisi',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');

        // Cek apakah email terdaftar
        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Email tidak terdaftar di sistem.',
            ])->withInput($request->only('email'))->with('error', 'Login gagal. Silakan periksa email dan password Anda.');
        }

        // Coba login
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            // Redirect berdasarkan role
            $redirectRoute = match(Auth::user()->role) {
                'tempat_wisata' => route('tempat-wisata.dashboard'),
                'tour_guide' => route('tour-guide.dashboard'),
                'admin' => route('admin.dashboard'),
                default => '/dashboard'
            };

            return redirect($redirectRoute)->with('success', 'Selamat datang kembali, ' . Auth::user()->name . '!');
        }

        return back()->withErrors([
            'password' => 'Password yang Anda masukkan salah.',
        ])->withInput($request->only('email'))->with('error', 'Login gagal. Silakan periksa email dan password Anda.');
    }

    /**
     * Show registration form
     */
    public function showRegisterForm()
    {
        return view('Login.registrasi');
    }

    /**
     * Handle registration request
     */
    public function register(Request $request)
    {
        // Validasi dengan pesan error yang lebih jelas
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'in:tour_guide,tempat_wisata'],
            'password_confirmation' => ['required'],
        ], [
            'name.required' => 'Nama lengkap harus diisi',
            'name.min' => 'Nama lengkap minimal 3 karakter',
            'name.max' => 'Nama lengkap maksimal 100 karakter',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid. Contoh: nama@email.com',
            'email.max' => 'Email maksimal 100 karakter',
            'email.unique' => 'Email sudah terdaftar. Silakan gunakan email lain atau login jika sudah punya akun.',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok dengan password',
            'password_confirmation.required' => 'Konfirmasi password harus diisi',
            'role.required' => 'Silakan pilih jenis akun (Tempat Wisata atau Tour Guide)',
            'role.in' => 'Jenis akun tidak valid',
        ]);

        try {
            $user = User::create([
                'name' => trim($validated['name']),
                'email' => strtolower(trim($validated['email'])),
                'password' => Hash::make($validated['password']),
                'role' => $validated['role'],
            ]);

            return redirect('/login')
                ->with('success', 'Registrasi berhasil! Silakan login dengan akun Anda.')
                ->with('registered_email', $user->email);

        } catch (\Exception $e) {
            return back()
                ->withInput($request->except('password', 'password_confirmation'))
                ->with('error', 'Terjadi kesalahan saat mendaftar. Silakan coba lagi.');
        }
    }

    /**
     * Handle logout request
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda telah logout.');
    }
}
