<?php
namespace App\Http\Controllers;

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
        return view('pengepul.pembelian.index');
    }

}