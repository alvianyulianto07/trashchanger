<?php
namespace App\Http\Controllers;

use App\Models\Sampah;
use App\Models\BankSampah;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

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
        $banksampah = BankSampah::all();
        $sampah = Sampah::all();
        $kategori = DB::table('kategori')->get();
        return view('pengepul.toko.index', compact('sampah', 'banksampah', 'kategori'));
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search($searchTerm)
    {
        $searchTerm = '%'.$searchTerm.'%';
        $sampah = Sampah::having('nama_sampah','LIKE', "%$searchTerm");;
        return view('pengepul.toko.searchresult', compact('sampah'));
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
        $banksampah = BankSampah::findOrFail($id);
        return view('pengepul.toko.show', compact('banksampah'));
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
        $sampah = Sampah::findOrFail($idsampah)->get();
        return view('pengepul.toko.showsampah', compact('sampah'));
    }
}