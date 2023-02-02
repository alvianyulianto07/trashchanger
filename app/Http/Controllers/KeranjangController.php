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

    
    public function buy (Request $request)
    {
        $validate = $request->validate([
            'bankSampah_id' => 'required',
            'sampah_id' => 'required',
            'jumlah_barang' => 'required',
            'total_harga' => 'required',
        ]);

        try {
            $keranjang = Keranjang::where('users_id', Auth::user()->id)->where('sampah_id', $request->sampah_id)->firstOrFail();
            $jumlahlama = (int) $keranjang->jumlah_barang;
            $jumlahtambahan = (int) $request->jumlah_barang;
            $jumlahbaru = (string) $jumlahlama + $jumlahtambahan;
            $keranjang->jumlah_barang = $jumlahbaru;
            $keranjang->save();
        } catch (ModelNotFoundException $ex) {
            $keranjang = Keranjang::create([
                'users_id' => Auth::user()->id,
                'bankSampah_id' => $request->bankSampah_id,
                'sampah_id' => $request->sampah_id,
                'jumlah_barang' => $request->jumlah_barang,
                'total_harga' => preg_replace('/[^0-9]/', '', $request->total_harga),
            ]);
        }

        return back()->with('success', 'Sukses Menambahkan Barang');
    }
}
