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


    public function haversineDistance($lat1, $lng1, $lat2, $lng2) {
        $earthRadius = 6371; // Radius of the Earth in kilometers
    
        // Convert latitude and longitude from degrees to radians
        $lat1Rad = deg2rad($lat1);
        $lng1Rad = deg2rad($lng1);
        $lat2Rad = deg2rad($lat2);
        $lng2Rad = deg2rad($lng2);
    
        // Difference in coordinates
        $dLat = $lat2Rad - $lat1Rad;
        $dLng = $lng2Rad - $lng1Rad;
    
        // Haversine formula
        $a = sin($dLat / 2) ** 2 + cos($lat1Rad) * cos($lat2Rad) * sin($dLng / 2) ** 2;
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        return $earthRadius * $c;
    }

    // Function to sort the points based on distance from the starting point
    public function sortPointsByDistance($start, $points) {
        $sortedPoints = [];
        $sortedKeys = [];
        array_push($sortedPoints, $start);

        while (count($points) > 0) {
            $nearestKey = array_key_first($points);

            $nearestDistance = $this->haversineDistance($start[0], $start[1], $points[array_key_first($points)][0], $points[array_key_first($points)][1]);
            
            foreach ($points as $key => $point) {
                $distance = $this->haversineDistance($start[0], $start[1], $point[0], $point[1]);
                if ($distance < $nearestDistance) {
                    $nearestDistance = $distance;
                    $nearestKey = $key;
                }
            }

            // Add the nearest point and its key to the sorted arrays
            $sortedPoints[] = $points[$nearestKey];
            $sortedKeys[] = $nearestKey;

            // Update the starting point
            $start = $points[$nearestKey];

            // Remove the nearest point from the original list
            unset($points[$nearestKey]);
        }
        
        return array(
            'key' => $sortedKeys,
            'points' => $sortedPoints
        );
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

        // $new_points = [];

        $user_lat = (float) Auth::user()->lat;
        $user_lng = (float) Auth::user()->lng;
        $new_points = ['start' => [$user_lat, $user_lng]];

        // dd($new_points);

        // $user_lat = (float) Auth::user()->lat;
        // $user_lng = (float) Auth::user()->lng;
        // $user_loc = array($user_lat, $user_lng);

        // array_push($new_points, $user_loc);

        $points = [];

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

            $cur_user_id = BankSampah::findOrFail($item->bankSampah_id)->users_id;
            $lat = (float) User::findOrFail($cur_user_id)->lat;
            $lng = (float) User::findOrFail($cur_user_id)->lng;

            $cur_loc = array($lat, $lng);
            if (!in_array($cur_loc, $points)) {
                // array_push($points, array($lat, $lng));
                $new_points[BankSampah::findOrFail($item->bankSampah_id)->nama_banksampah] = array($lat, $lng);
            }
            
        }

        $points_only = array_filter($new_points, function ($key) {
            return $key !== "start";
        }, ARRAY_FILTER_USE_KEY);
        $results = $this->sortPointsByDistance($new_points['start'], $points_only);

        $orderedplace = $results['key'];
        $points = $results['points'];

        $alltransaksi = $alltransaksi->groupBy('bankSampah_id');

        // dd($points);
        return view('pengepul.pembelian.show', compact('pembelian', 'alltransaksi', 'allbanksampah', 'points', 'orderedplace'));
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