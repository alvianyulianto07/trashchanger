<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
        $validate= $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users',
            'alamat' => 'required',
            'no_hp' => 'required',
            'password' => 'required|min:8',
            'check' => 'required'
        ]);
        $role = 1;
        if($request->check){
            $role = 2;
        }
        $user = User::create([
            'name' => $request->name,
            'email' =>  $request->email,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'role' => 1,
            'password' => Hash::make($request->password),
        ]);
        if($role == 1){
            return redirect('/login')->with('success','Anda berhasil mendaftar');
        } else {
            return redirect('/daftarbanksampah')->with('success','Anda dapat melanjutkan mendaftar menjadi Bank Sampah');
        }
    }

}
