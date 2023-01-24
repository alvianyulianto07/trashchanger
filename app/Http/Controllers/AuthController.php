<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/beranda');
        }
        return back()->with('login_gagal', 'login gagal');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'alamat' => 'required',
            'no_hp' => 'required',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
        ]);
        $role = "1";
        if ($request->check != null) {
            $role = "2";
        }
        $user = User::create([
            'nama' => $request->name,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'role' => $role,
            'password' => Hash::make($request->password),
        ]);
        if ($role == 1) {
            return redirect('/login')->with('success', 'Anda berhasil mendaftar');
        } else if ($role == 2) {
            return redirect('/daftarbanksampah')->with('success', 'Anda dapat melanjutkan mendaftar menjadi Bank Sampah');
        }
    }

}
