<?php
namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\BankSampah;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $id = Auth::user()->id;
        $keranjang = Keranjang::where('users_id', $id)->get();
        return view('pengepul.keranjang.index', compact('keranjang'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function checkout($id)
    {
        //
        return view('pengepul.keranjang.checkout');
    }
    
}