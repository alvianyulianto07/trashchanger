<?php
namespace App\Http\Controllers;

use App\Models\Sampah;
use App\Models\Kategori;
use App\Models\Keranjang;
use App\Models\BankSampah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TokoController extends Controller
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
        $banksampah = BankSampah::all();
        $sampah = Sampah::all();
        $kategori = Kategori::all();
        return view('pengepul.toko.index', compact('sampah', 'banksampah', 'kategori', 'searchquery'));
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $searchquery = $request->searchquery;
        $banksampah = BankSampah::all();
        $kategori = Kategori::all();
        $searchTerm = '%'.$searchquery.'%';
        $sampah = Sampah::where('nama_sampah','like', $searchTerm)->get();
        return view('pengepul.toko.searchresult', compact('sampah', 'banksampah', 'kategori', 'searchquery'));
    }

    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $searchquery = '';
        $banksampah = BankSampah::findOrFail($id);
        return view('pengepul.toko.show', compact('banksampah', 'searchquery'));
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showSampah($id, $idsampah)
    {
        //
        $searchquery = '';
        $sampah = Sampah::findOrFail($idsampah);
        return view('pengepul.toko.showsampah', compact('sampah', 'searchquery'));
    }

    public function addToCart(Request $request)
    {
        $validate = $request->validate([
            'bankSampah_id' => 'required',
            'sampah_id' => 'required',
            'jumlah_barang' => 'required',
            'total_harga' => 'required'
        ]);

        $keranjang = Keranjang::create([
            'users_id' => Auth::user()->id,
            'bankSampah_id' => $request->bankSampah_id,
            'sampah_id' => $request->sampah_id,
            'jumlah_barang' => $request->jumlah_barang,
            'total_harga' => $request->total_harga
        ]);
        return back()->with('success', 'Sukses Menambahkan Barang');
    }
}