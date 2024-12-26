<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BankSampah;
use App\Models\Kategori;
use App\Models\Keranjang;
use App\Models\Sampah;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Models\Pembelian;
use App\Models\Transaksi;

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
        $sampah = Sampah::where('status', 'Tersedia')->get();
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
        try {
            $type = $request->searchtype;

            $banksampah = BankSampah::all();
            $kategori = Kategori::all();


            if ($type == "search" )
            {
                $searchquery = $request->searchquery;
                $searchTerm = '%' . $searchquery . '%';
                $sampah = Sampah::where('nama_sampah', 'like', $searchTerm)->where('status', 'Tersedia')->get();
            } else if ($type == "filter") {
                $filterquery = $request->filterquery;
                $filterTerm = '%' . $filterquery . '%';

                $kategori_id = Kategori::where('nama_kategori', 'like', $filterTerm)->firstOrFail();
                $sampah = Sampah::where('kategori_id', 'like', $kategori_id->id)->where('status', 'Tersedia')->get();

                $searchquery = "";
                // dd($sampah);
            }
        } catch (MethodNotAllowedHttpException $e) {
            $searchquery = '';
            $banksampah = BankSampah::all();
            $sampah = Sampah::where('status', 'Tersedia')->get();
            $kategori = Kategori::all();
        }
        // dd($sampah);
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
        $kategori = Kategori::all();
        $sampah = Sampah::where('bankSampah_id', $banksampah->id)->where('status', 'Tersedia')->get();
        return view('pengepul.toko.show', compact('banksampah', 'searchquery', 'sampah', 'kategori'));
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
        $banksampah = BankSampah::findOrFail($id);
        $user = User::findOrFail($banksampah->users_id);
        $kategori = Kategori::all();
        $alamatbanksampah = User::findOrFail($banksampah->users_id)->alamat;
        $sampah = Sampah::findOrFail($idsampah);
        $koordinat = [$user->lat, $user->lng];
        return view('pengepul.toko.showsampah', compact('sampah', 'banksampah', 'kategori', 'searchquery', 'alamatbanksampah', 'koordinat'));
    }

    public function addToCart(Request $request)
    {
        $validate = $request->validate([
            'bankSampah_id' => 'required',
            'sampah_id' => 'required',
            'jumlah_barang' => 'required',
            'total_harga' => 'required',
            'action_type' => 'required'
        ]);

        if ($request->action_type === 'tambah') {
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
        } elseif ($request->action_type === 'beli') {

            $bankSampah_id = $request->bankSampah_id;
            $sampah_id = $request->sampah_id;
            $jumlah_barang = $request->jumlah_barang;
            $total_harga = $request->total_harga;

            $characters = 'abcdefghijklmnopqrstuvwxyz';
            $randomString = '';

            for ($i = 0; $i < 5; $i++) {
                $index = rand(0, strlen($characters) - 1);
                $randomString .= $characters[$index];
            }

            $id = Auth::user()->id;
            $autocancelledtime = Carbon::now()->addHours(24)->toDateTimeString();
            $time = Carbon::now()->toDateTimeString();
            $invoice_num = strtoupper($randomString);
            $invoice_date = Carbon::now()->isoFormat('YMMDD');

            $invoice_all = $invoice_date . $invoice_num;

            Pembelian::create([
                "num_invoice" => $invoice_all,
                "users_id" => $id,
                "tanggal" => $time,
                "tanggal_batal" => $autocancelledtime,
                "total_harga" => preg_replace('/[^0-9]/', '', $total_harga),
            ]);

            $pembelian = Pembelian::where("users_id", $id)->where("tanggal", $time)->firstOrFail();
            Transaksi::create([
                "sampah_id" => $sampah_id,
                "bankSampah_id" => $bankSampah_id,
                "pembelian_id" => $pembelian->id,
                "jumlah_barang" => $jumlah_barang,
                "total_harga" => preg_replace('/[^0-9]/', '', $total_harga),
                "status" => "Dalam Proses",
            ]);
                
            $sampah = Sampah::findOrFail($sampah_id);
            
            $current_stok = $sampah->jumlah;
            $new_stok = $current_stok - $jumlah_barang;
            $sampah->jumlah = $new_stok;
            $sampah->save();
            
            return redirect('/pembelian');
            // Logic to handle direct purchase
        }


    }
}
