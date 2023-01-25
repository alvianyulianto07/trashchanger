<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sampah;
use App\Models\BankSampah;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SampahController extends Controller
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
        return view('sampah.index', compact('sampah'));
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
        $id_banksampah = BankSampah::where('$users_id', $id);

        $user = User::create([
            'nama_sampah' => $request->name,
            'jumlah' => $request->jumlah,
            'harga' => $request->harga,
            'bankSampah_id' => $id_banksampah,
            'kategori' => $request->kategori,
        ]);

        return redirect('/banksampah')->with('success', 'Penambahan Sampah Berhasil');
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
        $sampah = Sampah::findorfail($id);
        return view('sampah.show', compact('sampah'));
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
        $sampah = Sampah::findorfail($id);
        return view('sampah.edit', compact('sampah'));
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
        ]);
        $sampah = Sampah::findorfail($id);
        $sampah->nama_sampah = $request->name;
        $sampah->jumlah = $request->jumlah;
        $sampah->harga = $request->harga;
        $sampah->save();

        return redirect()->route('pelanggan.index')->with('success', 'Data sampah anda berhasil diupdate');
    
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
