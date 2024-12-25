<?php
namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\BankSampah;
use App\Models\Sampah;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Pembelian;
use \Datetime;
use PDF;

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
        ->where('bank_sampah.id', '=', $banksampahid) 
        ->select('pembelian.id', 'pembelian.num_invoice', 'pembelian.tanggal', 'users.nama', 'pembelian.total_harga', 'transaksi.status')
        ->orderBy('pembelian.id', 'desc')
        ->get()
        ->groupBy(['id', 'status']);
        // dd($allpenjualan);
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

        $user_id = Auth::user()->id;
        $databanksampah = BankSampah::where('users_id', $user_id)->firstOrFail();      
        $banksampah_id = $databanksampah->id;

        $pembelian = Pembelian::where('id', $id)->firstOrFail();
        $pembelian_id = $pembelian->id;

        // dd($banksampah_id);
        $transaksi = Transaksi::where('pembelian_id', $pembelian_id)
        ->where('bankSampah_id', $banksampah_id)->get();

        foreach ($transaksi as $data) {
            $data->status = $request->status;
            $data->save();
        }

        return redirect('/penjualan')->with('success','Data berhasil diubah');
        // return redirect()->route('penjualan.index')->with('success', 'Data penjualan anda berhasil diperbarui');

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

    public function generate($id)
    {

        $user_id = Auth::user()->id;

        $datapembelian = Pembelian::where('id', $id)->firstOrFail();
        $pembelian_id = $datapembelian->id;
        $pembelian_invoice = $datapembelian->num_invoice;
        $pembelian_date = $datapembelian->tanggal;
        $pembelian_date_in_format = new DateTime($pembelian_date);
        
        $databanksampah = BankSampah::where('users_id', $user_id)->firstOrFail();        
        $banksampah_name = $databanksampah->nama_banksampah;
        $banksampah_id = $databanksampah->id;

        $datauser = User::where('id', $user_id)->firstOrFail();        
        $banksampah_address = $datauser->alamat;
        $banksampah_phone = $datauser->no_hp;
        

        $items = [];
        $total = 0;
        $datatransaksi = Transaksi::where('pembelian_id', $pembelian_id)
                ->where('banksampah_id', $banksampah_id)
                ->get();
        foreach ($datatransaksi as $data) {
            $c_sampah = Sampah::where('id', $data->sampah_id)->firstOrFail();
            
            $items[] = [
                'name' => $c_sampah->nama_sampah,
                'price' => $c_sampah->harga,
                'stock' => $data->jumlah_barang,
                'total' => $c_sampah->harga * $data->jumlah_barang,
            ];
            $total = $total + ($c_sampah->harga * $data->jumlah_barang);
        }

        // Define data for the invoice
        $data = [
            'bank_name' => $banksampah_name,
            'address' => $banksampah_address,
            'phone' => $banksampah_phone,
            'date' => $pembelian_date_in_format->format('d/m/Y H:i'),
            'invoice_number' => $pembelian_invoice,
            'items' => $items,
            'grand_total' => $total,
        ];
        
        $pdf = PDF::loadView('banksampah.penjualan.invoice', $data);
        $pdf->setPaper('A5', 'portrait'); // or 'landscape' for landscape orientation

        $filename = $banksampah_name . "_" . $pembelian_invoice . "_" . $pembelian_date_in_format->format('d_m_Y_H_i') . ".pdf";

        return $pdf->download($filename);
    }
}
