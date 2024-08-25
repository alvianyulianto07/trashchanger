<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BankSampah;
use App\Models\Keranjang;
use App\Models\Sampah;
use App\Models\Pembelian;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
            ->groupBy('bankSampah_id');
        $banksampah = BankSampah::all();

        // dd($cart);
        return view('pengepul.keranjang.index', compact('cart', 'searchquery', 'banksampah'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function checkout(Request $request)
    {
        $collect = [];

        $total_harga = null;

        foreach ($request->all() as $input_key => $input_value) {
            if ($input_key != "cbperitem" && $input_value != null && $input_key != "_token" && $input_key != "total_bayar") {
                $id = $input_value['id'];
                $jumlah_barang = $input_value['jumlah_barang'];
                $total_harga = $input_value['total_harga'];
                if ($id != null) {
                    $collect[] = array(
                        'idkeranjang' => $id,
                        'jumlah_barang' => $jumlah_barang,
                        'total_harga' => $total_harga,
                    );
                }
            } else if($input_key == "total_bayar"){
                $total_harga = $input_value;
            }
        }
        if ($collect != []) {

            $id = Auth::user()->id;
            $autocancelledtime = Carbon::now()->addSeconds(10)->toDateTimeString();
            $time = Carbon::now()->toDateTimeString();
            Pembelian::create([
                "users_id" => $id,
                "tanggal" => $time,
                "tanggal_batal" => $autocancelledtime,
                "total_harga" => preg_replace('/[^0-9]/', '', $total_harga),
            ]);
            foreach ($collect as $order) {
                $keranjang = Keranjang::findOrFail($order['idkeranjang']);
                $pembelian = Pembelian::where("users_id", $id)->where("tanggal", $time)->firstOrFail();
                Transaksi::create([
                    "sampah_id" => $keranjang->sampah_id,
                    "bankSampah_id" => $keranjang->bankSampah_id,
                    "pembelian_id" => $pembelian->id,
                    "jumlah_barang" => $order['jumlah_barang'],
                    "total_harga" => preg_replace('/[^0-9]/', '', $order['total_harga']),
                    "status" => "Dalam Proses",
                ]);
                
                $sampah = Sampah::findOrFail($keranjang->sampah_id);
                
                $current_stok = $sampah->jumlah;
                $new_stok = $current_stok - $order['jumlah_barang'];
                $sampah->jumlah = $new_stok;
                $sampah->save();
                
                $keranjang->delete();
            }
            return redirect('/pembelian');
        }
        return back()->with('success', 'Sukses Menambahkan Barang');
    }
}
