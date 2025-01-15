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
use Illuminate\Http\Request;
use PDF;

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
    public function laporan(Request $request)
    {
        $currentYear = now()->year;

        $years = [];
        for ($i = 0; $i < 5; $i++) {
            $years[] = $currentYear - $i;
        }
        $months = [
            'Desember',
            'November',
            'Oktober',
            'September',
            'Agustus',
            'Juli',
            'Juni',
            'Mei',
            'April',
            'Maret',
            'Februari',
            'Januari'
        ];
        $months_map = [
            'Januari' => '01',
            'Februari' => '02',
            'Maret' => '03',
            'April' => '04',
            'Mei' => '05',
            'Juni' => '06',
            'Juli' => '07',
            'Agustus' => '08',
            'September' => '09',
            'Oktober' => '10',
            'November' => '11',
            'Desember' => '12',
        ];

        $id = Auth::user()->id;
        $s_year = $request->year;
        $s_month = $request->month;

        $alltransaksi = Pembelian::join('users', 'users.id', '=', 'pembelian.users_id')
        ->join('transaksi', 'transaksi.pembelian_id', '=', 'pembelian.id')
        ->join('bank_sampah', 'bank_sampah.id', '=', 'transaksi.bankSampah_id')
        ->join('sampah', 'sampah.id', '=', 'transaksi.sampah_id')
        ->join('kategori', 'kategori.id', '=', 'sampah.kategori_id')
        ->where('transaksi.status', 'Selesai')
        ->where('pembelian.users_id', $id);

        if ($s_year != 'all') {
            if ($s_year == 'current'){
                $s_year = $currentYear;
                $alltransaksi->whereYear('pembelian.tanggal', $s_year);
            } else {
                $alltransaksi->whereYear('pembelian.tanggal', $s_year);
            }
        }
        if (($s_month != 'all' && $s_year != 'all') && $s_year != 'all') {
            $c_month = $months_map[$s_month];
            $alltransaksi->whereMonth('pembelian.tanggal', $c_month);
        }

        $alltransaksi = $alltransaksi->orderBy('pembelian.tanggal', 'desc')
            ->select(
                'pembelian.tanggal',
                'bank_sampah.nama_banksampah',
                'sampah.nama_sampah',
                'transaksi.jumlah_barang',
                'sampah.harga',
                DB::raw('transaksi.jumlah_barang * sampah.harga as total_harga')
            )
            ->get();

        $grand_total = $alltransaksi->sum('total_harga');

        $searchquery = '';

        return view('pengepul.pembelian.laporan', compact('searchquery', 'years', 'months', 'alltransaksi', 's_year', 's_month', 'grand_total'));
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


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generate(Request $request)
    {
        $searchquery = '';
        $currentYear = now()->year;

        $years = [];
        for ($i = 0; $i < 5; $i++) {
            $years[] = $currentYear - $i;
        }
        $months = [
            'Desember',
            'November',
            'Oktober',
            'September',
            'Agustus',
            'Juli',
            'Juni',
            'Mei',
            'April',
            'Maret',
            'Februari',
            'Januari'
        ];
        $months_map = [
            'Januari' => '01',
            'Februari' => '02',
            'Maret' => '03',
            'April' => '04',
            'Mei' => '05',
            'Juni' => '06',
            'Juli' => '07',
            'Agustus' => '08',
            'September' => '09',
            'Oktober' => '10',
            'November' => '11',
            'Desember' => '12',
        ];

        $id = Auth::user()->id;
        $s_year = $request->year;
        $s_month = $request->month;

        $alltransaksi = Pembelian::join('users', 'users.id', '=', 'pembelian.users_id')
        ->join('transaksi', 'transaksi.pembelian_id', '=', 'pembelian.id')
        ->join('bank_sampah', 'bank_sampah.id', '=', 'transaksi.bankSampah_id')
        ->join('sampah', 'sampah.id', '=', 'transaksi.sampah_id')
        ->join('kategori', 'kategori.id', '=', 'sampah.kategori_id')
        ->where('transaksi.status', 'Selesai')
        ->where('pembelian.users_id', $id);

        if ($s_year != 'all') {
            if ($s_year == 'current'){
                $s_year = $currentYear;
                $alltransaksi->whereYear('pembelian.tanggal', $s_year);
            } else {
                $alltransaksi->whereYear('pembelian.tanggal', $s_year);
            }
        }
        if (($s_month != 'all' && $s_year != 'all') && $s_year != 'all') {
            $c_month = $months_map[$s_month];
            $alltransaksi->whereMonth('pembelian.tanggal', $c_month);
        }

        $grand_total = $alltransaksi->sum('pembelian.total_harga');

        $alltransaksi = $alltransaksi->orderBy('pembelian.tanggal', 'desc')
            ->select(
                'pembelian.tanggal',
                'bank_sampah.nama_banksampah',
                'sampah.nama_sampah',
                'transaksi.jumlah_barang',
                'sampah.harga',
                DB::raw('transaksi.jumlah_barang * sampah.harga as total_harga')
            )
            ->get();

        $grand_total = $alltransaksi->sum('total_harga');

    
        $items = [];
        foreach ($alltransaksi as $data) {
            $items[] = [
                'tanggal' => $data->tanggal,
                'nama_banksampah' => $data->nama_banksampah,
                'nama_sampah' => $data->nama_sampah,
                'jumlah_barang' => $data->jumlah_barang,
                'harga' => $data->harga,
                'total_harga' => $data->total_harga ,
            ];
            
        }

        $period = "";


        if ($s_year == "all")
        {
            $period = "Semua Periode";
        }

        if ($s_year != "all" && $s_month != "all")
        {
            $period = $s_year . " " . $s_month;
        } else if ($s_year != "all" && $s_month == "all")
        {
            $period = $s_year;
        }

        $data = [
            'period' => $period,
            'items' => $items,
            'grand_total' => $grand_total,
        ];
        
        $pdf = PDF::loadView('pengepul.pembelian.report', $data);
        $pdf->setPaper('A4', 'landscape'); // or 'landscape' for landscape orientation

        $filename = "Laporan Pembelian Periode " . $period . ".pdf";
    
        return $pdf->download($filename);
    }


    // public function generate($id)
    // {

    //     $user_id = Auth::user()->id;

    //     $datapembelian = Pembelian::where('id', $id)->firstOrFail();
    //     $pembelian_id = $datapembelian->id;
    //     $pembelian_invoice = $datapembelian->num_invoice;
    //     $pembelian_date = $datapembelian->tanggal;
    //     $pembelian_date_in_format = new DateTime($pembelian_date);
        
    //     $databanksampah = BankSampah::where('users_id', $user_id)->firstOrFail();        
    //     $banksampah_name = $databanksampah->nama_banksampah;
    //     $banksampah_id = $databanksampah->id;

    //     $datauser = User::where('id', $user_id)->firstOrFail();        
    //     $banksampah_address = $datauser->alamat;
    //     $banksampah_phone = $datauser->no_hp;
        

    //     $items = [];
    //     $total = 0;
    //     $datatransaksi = Transaksi::where('pembelian_id', $pembelian_id)
    //             ->where('banksampah_id', $banksampah_id)
    //             ->get();
    //     foreach ($datatransaksi as $data) {
    //         $c_sampah = Sampah::where('id', $data->sampah_id)->firstOrFail();
            
    //         $items[] = [
    //             'name' => $c_sampah->nama_sampah,
    //             'price' => $c_sampah->harga,
    //             'stock' => $data->jumlah_barang,
    //             'total' => $c_sampah->harga * $data->jumlah_barang,
    //         ];
    //         $total = $total + ($c_sampah->harga * $data->jumlah_barang);
    //     }

    //     // Define data for the invoice
    //     $data = [
    //         'bank_name' => $banksampah_name,
    //         'address' => $banksampah_address,
    //         'phone' => $banksampah_phone,
    //         'date' => $pembelian_date_in_format->format('d/m/Y H:i'),
    //         'invoice_number' => $pembelian_invoice,
    //         'items' => $items,
    //         'grand_total' => $total,
    //     ];
        
    //     $pdf = PDF::loadView('banksampah.penjualan.invoice', $data);
    //     $pdf->setPaper('A5', 'portrait'); // or 'landscape' for landscape orientation

    //     $filename = $banksampah_name . "_" . $pembelian_invoice . "_" . $pembelian_date_in_format->format('d_m_Y_H_i') . ".pdf";

    //     return $pdf->download($filename);
    // }
    
}