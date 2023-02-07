<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BankSampah;
use App\Models\Keranjang;
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

        foreach ($request->all() as $input_key => $input_value) {
            if ($input_key != "cbperitem" && $input_value != null && $input_key != "_token") {
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
            }
        }
        if ($collect != []) {

            $id = Auth::user()->id;
            $time = Carbon::now()->isoFormat('YYYY-MM-DD');
            Pembelian::create([
                "users_id" => $id,
                "tanggal" => $time,
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
                $keranjang->delete();
            }
            return redirect('/pembelian');
        }
        return back()->with('success', 'Sukses Menambahkan Barang');
    }
}
