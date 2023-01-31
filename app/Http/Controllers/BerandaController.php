<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BerandaController extends Controller
{
    public function index()
    {
        if(Auth::user() == "null"){
            return view('beranda.index');
        } else if (Auth::user()->role == "1"){
            return redirect()->intended('/beranda');
        } else {
            return redirect()->intended('/sampah');
        }
    }

}
