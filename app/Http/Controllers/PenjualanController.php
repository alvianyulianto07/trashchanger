<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $penjualan = Transaksi::where('bank', Auth::user()->id)->get();
        $banksampahid = 0;
        foreach($banksampah as $data){
            $banksampahid = $data->id;
        }
        $sampah = Sampah::where('bankSampah_id', $banksampahid)->get();
        return view('banksampah.penjualan.index', compact('sampah'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $validate = $request->validate([
            'name' => 'required',
            'jumlah' => 'required',
            'harga' => 'required',
            'kategori' => 'required',
        ]);

        $id = Auth::user()->id;
        $banksampah = BankSampah::where('users_id', $id);
        $banksampahid = 0;
        foreach($banksampah as $data){
            $banksampahid = $data->id;
        }

        $sampah = Sampah::create([
            'nama_sampah' => $request->name,
            'jumlah' => $request->jumlah,
            'harga' => $request->harga,
            'bankSampah_id' => $banksampahid,
            'kategori_id' => $request->kategori,
        ]);

        return redirect('/sampah')->with('success', 'Penambahan Sampah Berhasil');
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $sampah = Sampah::findOrFail($id);
        return view('banksampah.sampah.show', compact('sampah'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $sampah = Sampah::findOrFail($id);
        return view('banksampah.sampah.edit', compact('sampah'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'name' => 'required',
            'jumlah' => 'required',
            'harga' => 'required',
            'kategori' => 'required',
        ]);
        $sampah = Sampah::findOrFail($id);
        $sampah->nama_sampah = $request->name;
        $sampah->jumlah = $request->jumlah;
        $sampah->harga = $request->harga;
        $sampah->kategori_id = $request->kategori;
        $sampah->save();

        return redirect()->route('sampah.index')->with('success', 'Data sampah anda berhasil diperbarui');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}