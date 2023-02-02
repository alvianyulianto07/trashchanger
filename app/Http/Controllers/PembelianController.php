<?php
namespace App\Http\Controllers;

use App\Models\Sampah;
use App\Models\Kategori;
use App\Models\BankSampah;
use App\Http\Controllers\Controller;

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
        $kategori = Kategori::all();
        return view('pengepul.pembelian.index', compact('sampah', 'banksampah', 'kategori', 'searchquery'));
    }

    
}