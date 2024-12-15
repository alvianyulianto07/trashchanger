<?php
namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\BankSampah;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $banksampah = BankSampah::where('users_id', Auth::user()->id)->get();
        // $bs_id = $banksampah->id;
        $banksampahid = 0;
        foreach ($banksampah as $data) {
            $banksampahid = $data->id;
        }
        // $penjualan = Transaksi::where('bankSampah_id', $banksampahid)->get();


        $allpenjualan = Transaksi::join('bank_sampah', 'bank_sampah.id', '=', 'transaksi.bankSampah_id')
        ->join('pembelian', 'pembelian.id', '=', 'transaksi.pembelian_id')
        ->join('sampah', 'sampah.id', '=', 'transaksi.sampah_id')
        ->join('users', 'users.id', '=', 'pembelian.users_id')
        ->join('kategori', 'kategori.id', '=', 'sampah.kategori_id')
        ->orderBy('transaksi.created_at', 'desc')
        ->select('sampah.nama_sampah', 'sampah.foto', 'sampah.harga', 'transaksi.jumlah_barang', 'transaksi.total_harga', 'users.nama', 'transaksi.status')
        ->get();
        // ->groupBy(['status', 'id', 'nama_banksampah']);
        // $kategori = Kategori::all();

        // dd($allpenjualan);

        return view('banksampah.penjualan.index', compact('allpenjualan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $transaksi = Transaksi::findOrFail($id);
        return view('banksampah.penjualan.show', compact('transaksi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $transaksi = Transaksi::findOrFail($id);
        return view('banksampah.penjualan.edit', compact('transaksi'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'status' => 'required',
        ]);
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->status = $request->status;
        $transaksi->save();

        return redirect()->route('penjualan.index')->with('success', 'Data penjualan anda berhasil diperbarui');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
