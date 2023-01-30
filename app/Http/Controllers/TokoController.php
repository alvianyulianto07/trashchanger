<?php
namespace App\Http\Controllers;

use App\Models\Sampah;
use App\Models\BankSampah;
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
        $sampah = Sampah::all();
        return view('pengepul.toko.index', compact('sampah'));
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
        return view('pengepul.toko.showsampah', compact('banksampah'));
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
        $sampah = sampah::findOrFail($idsampah);
        return view('pengepul.toko.show', compact('sampah'));
    }
}