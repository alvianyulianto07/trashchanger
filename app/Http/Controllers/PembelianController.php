<?php
namespace App\Http\Controllers;

use App\Models\Sampah;
use App\Models\Kategori;
use App\Models\Pembelian;
use App\Models\BankSampah;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PembelianController extends Controller
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
        $sampah = Sampah::where('status', 'Tersedia')->get();

        $id = Auth::user()->id;
        $allpembelian = Pembelian::join('users', 'users.id', '=', 'pembelian.users_id')
        ->join('transaksi', 'transaksi.pembelian_id', '=', 'pembelian.id')
        ->join('bank_sampah', 'bank_sampah.id', '=', 'transaksi.bankSampah_id')
        ->join('sampah', 'sampah.id', '=', 'transaksi.sampah_id')
        ->join('kategori', 'kategori.id', '=', 'sampah.kategori_id')
        ->where('pembelian.users_id', $id)
        ->select('pembelian.id', 'bank_sampah.nama_banksampah', 'transaksi.status', 'sampah.nama_sampah', 'pembelian.total_harga')
        ->get()
        ->groupBy(['id', 'nama_banksampah']);

        $kategori = Kategori::all();
        return view('pengepul.pembelian.index', compact('sampah', 'banksampah', 'kategori', 'searchquery', 'allpembelian'));
    }

    
}