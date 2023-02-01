<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Keranjang;
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
        $searchquery = '';
        $id = Auth::user()->id;
        $allcart = Keranjang::join('users', 'users.id', '=', 'keranjang.users_id')
            ->join('bank_sampah', 'bank_sampah.id', '=', 'keranjang.bankSampah_id')
            ->join('sampah', 'sampah.id', '=', 'keranjang.sampah_id')
            ->where('keranjang.users_id', $id);
        $cart = $allcart->get(['keranjang.*', 'bank_sampah.nama_banksampah',
            'sampah.nama_sampah', 'sampah.harga', 'sampah.foto'])
            ->groupBy('nama_banksampah');
        return view('pengepul.keranjang.index', compact('cart', 'searchquery'));
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
