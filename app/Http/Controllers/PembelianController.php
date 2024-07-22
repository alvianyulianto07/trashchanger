<?php
namespace App\Http\Controllers;

use App\Models\Sampah;
use App\Models\Kategori;
use App\Models\Pembelian;
use App\Models\Transaksi;
use App\Models\BankSampah;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

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

        $allpembelian = Pembelian::join('transaksi', 'transaksi.pembelian_id', '=', 'pembelian.id')
        ->where('pembelian.users_id', $id)
        ->get()
        ->groupBy(['pembelian_id']);

        $time = Carbon::now()->toDateTimeString();
        $cancelledid = [];
        foreach ($allpembelian as $pembelian) {
            foreach ($pembelian as $cur_trasanction) {
                $cancelled_date = $cur_trasanction->tanggal_batal;
                if ($time > $cancelled_date){
                    if ($cur_trasanction->status == "Dalam Proses") {
                        $trx = Transaksi::findOrFail($cur_trasanction->id);
                        $trx->status = "Dibatalkan";
                        $trx->save();

                        $sampah = Sampah::findOrFail($trx->sampah_id);
                        
                        $current_stok = $sampah->jumlah;
                        $new_stok = $current_stok + $trx->jumlah_barang;
                        $sampah->jumlah = $new_stok;
                        $sampah->save();
                    }
                    // if (!in_array($cur_trasanction->pembelian_id, $cancelledid)) {
                    //     array_push($cancelledid, $cur_trasanction->pembelian_id);
                    // }
                }
            }
        }

        $allpembelian = Pembelian::join('users', 'users.id', '=', 'pembelian.users_id')
        ->join('transaksi', 'transaksi.pembelian_id', '=', 'pembelian.id')
        ->join('bank_sampah', 'bank_sampah.id', '=', 'transaksi.bankSampah_id')
        ->join('sampah', 'sampah.id', '=', 'transaksi.sampah_id')
        ->join('kategori', 'kategori.id', '=', 'sampah.kategori_id')
        ->where('pembelian.users_id', $id)
        ->orderBy('transaksi.created_at', 'desc')
        ->select('pembelian.id', 'sampah.foto', 'bank_sampah.nama_banksampah', 'transaksi.status', 'sampah.nama_sampah', 'pembelian.total_harga')
        ->get()
        ->groupBy(['status', 'id', 'nama_banksampah']);
        $kategori = Kategori::all();
        // dd($allpembelian);


        $alltanggalbatal = Pembelian::join('users', 'users.id', '=', 'pembelian.users_id')
        ->join('transaksi', 'transaksi.pembelian_id', '=', 'pembelian.id')
        ->select('pembelian.id', 'pembelian.tanggal_batal', 'transaksi.status')
        ->get()
        ->groupBy(['id']);

        // dd($alltanggalbatal);
        return view('pengepul.pembelian.index', compact('sampah', 'banksampah', 'kategori', 'searchquery', 'allpembelian', 'alltanggalbatal'));
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($pembelianid)
    {
        //
        $allbanksampah = BankSampah::all();
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
                'no_bs' => User::findOrFail(BankSampah::findOrFail($item->bankSampah_id)->users_id)->no_hp,
                'sampah_id' => $item->sampah_id,
                'foto' => $sampah->foto,
                'nama_sampah' => $sampah->nama_sampah,
                'jumlah_barang' => $item->jumlah_barang,
                'harga_satuan' => $sampah->harga,
                'total_harga' => $item->total_harga,
                'status' => $item->status,
            ]);
        }
        $alltransaksi = $alltransaksi->groupBy('bankSampah_id');
        return view('pengepul.pembelian.show', compact('pembelian', 'alltransaksi', 'allbanksampah'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pembelian = Pembelian::findOrFail($id);
        $pembelian->status = "Diarsip";
        $pembelian->save();
        return redirect()->route('pembelian.index')->with('success', 'Pembelian dibatalkan');

    }
    
}