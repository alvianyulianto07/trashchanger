<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BankSampah;
use App\Models\User;
use GuzzleHttp\Client;
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

    public function daftarbanksampah()
    {
        return view('auth.registbanksampah');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (Auth::user()->role == "0") {
                return redirect()->intended('/beranda');
            } else if (Auth::user()->role == "1") {
                return redirect()->intended('/beranda');
            } else {
                return redirect()->intended('/sampah');
            }
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
        $address = "16-18, Argyle Street, Camden, London, WC1H 8EG, United Kingdom";
        $result = app('geocoder')->geocode($address)->get();
        $coordinates = $result[0]->getCoordinates();
        $lat = $coordinates->getLatitude();
        $long = $coordinates->getLongitude();
        
        dd($coordinates);

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
        if ($role == "1") {
            return redirect('/login')->with('success', 'Anda berhasil mendaftar');
        } else if ($role == "2") {
            $credentials = $request->validate([
                'email' => 'required',
                'password' => 'required',
            ]);
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect('/daftarbanksampah')->with('success', 'Anda dapat melanjutkan mendaftar menjadi Bank Sampah');
            }
            return back()->with('login_gagal', 'login gagal');
        }
    }

    public function create(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
        ]);
        $banksampah = BankSampah::create([
            'nama_banksampah' => $request->name,
            'users_id' => Auth::user()->id,
            'status' => "Mengajukan",
        ]);
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', 'Anda berhasil mendaftar');

    }

}
