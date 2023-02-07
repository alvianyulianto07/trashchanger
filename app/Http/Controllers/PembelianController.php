<?php
namespace App\Http\Controllers;

use App\Models\Sampah;
use App\Models\Kategori;
use App\Models\Pembelian;
use App\Models\Transaksi;
use App\Models\BankSampah;
use Illuminate\Support\Collection;
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

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($pembelianid)
    {
        //
        $searchquery = '';
        $banksampah = BankSampah::all();
        $sampah = Sampah::where('status', 'Tersedia')->get();

        $id = Auth::user()->id;
        $pembelian = Pembelian::findOrFail($pembelianid);

        $alltransaksi = new Collection();

        $transaksi = Transaksi::where('pembelian_id', $pembelianid)->get();
        foreach($transaksi as $item){
            $sampah = Sampah::findOrFail($item->sampah_id);
            $alltransaksi->push((object)[
                'bankSampah_id' => $item->bankSampah_id,
                'nama_bankSampah' => BankSampah::findOrFail($item->bankSampah_id)->nama_banksampah,
                'sampah_id' => $item->sampah_id,
                'nama_sampah' => $sampah->nama_sampah,
                'jumlah_barang' => $item->jumlah_barang,
                'harga_satuan' => $sampah->harga,
                'total_harga' => $item->total_harga,
            ]);
        }
        $alltransaksi = $alltransaksi->groupBy('bankSampah_id');
        dd($alltransaksi);
        return view('pengepul.pembelian.show', compact('searchquery', 'pembelian', 'alltransaksi'));
    }
    
}