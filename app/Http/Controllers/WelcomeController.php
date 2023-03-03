<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\BankSampah;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    public function index()
    {
        if (Auth::user() == null) {

            $banksampah = BankSampah::all();
            $listbanksampah = array();
            foreach($banksampah as $bank){
                $users = User::findOrFail($bank->users_id);
                $banksampahloc = [$users->lat, $users->lng];
                array_push($listbanksampah, $banksampahloc);
            }
            return view('welcome.index', compact('listbanksampah'));
        } else if (Auth::user()->role == "1") {
            return redirect()->intended('/beranda');
        } else {
            return redirect()->intended('/sampah');
        }
    }

}
