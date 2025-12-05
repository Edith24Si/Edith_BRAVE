<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');

        {
            if (Auth::check()) {
                //Redirect ke halaman dashboard
            }
            //Redirect ke halaman login
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        // Periksa apakah pengguna ditemukan DAN password cocok
        if ($user && Hash::check($request->password, $user->password)) {

                                // 1. Lakukan Autentikasi
            Auth::login($user); // Menambahkan Auth::login($user) di sini

                                              // 2. SIMPAN WAKTU KE SESSION (Sesuai instruksi)
            session(['last_login' => now()]); // Menambahkan session(['last_login' => now()]) di sini

            // 3. Redirect ke halaman dashboard
            return redirect()->route('dashboard')->with('success', 'Login berhasil!');

        } else {
            // Jika login gagal
            return back()->withErrors(['email' => 'Email atau password salah'])->withInput();
        }

        // Blok if yang kedua di kode Anda dihilangkan karena tidak akan pernah dieksekusi
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();      // Hapus semua session
        $request->session()->regenerateToken(); // Cegah CSRF

        // Redirect ke halaman login
    }
}
