<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BankSampah;
use App\Models\Kategori;
use App\Models\Sampah;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        $banksampah = BankSampah::where('users_id', Auth::user()->id)->get();
        $banksampahid = 0;
        foreach ($banksampah as $data) {
            $banksampahid = $data->id;
        }
        $sampah = Sampah::where('bankSampah_id', $banksampahid)->where('status', 'Tersedia')->get();
        $kategori = Kategori::all();
        return view('banksampah.sampah.index', compact('sampah', 'kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $kategori = Kategori::all();
        return view('banksampah.sampah.create', compact('kategori'));
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
        $validate = $request->validate([
            'nama_sampah' => 'required',
            'jumlah' => 'required',
            'harga' => 'required',
            'kategori' => 'required',
            'foto' => 'required',
        ]);

        $id = Auth::user()->id;
        $banksampah = BankSampah::where('users_id', $id)->get();
        $banksampahid = 0;
        foreach ($banksampah as $data) {
            $banksampahid = $data->id;
        }

        $num = rand(1, 100);
        $basenamefile = str_replace(' ', '_', $request->name);

        $newName = "";
        if ($request->hasFile('foto')) {
            $extension = $request->file('foto')->getClientOriginalExtension();
            $newName = $basenamefile . $id . '&upd=' . $num . '.' . $extension;
            $request->file('foto')->storeAs('foto', $newName);
        }

        $sampah = Sampah::create([
            'nama_sampah' => $request->nama_sampah,
            'jumlah' => $request->jumlah,
            'harga' => preg_replace('/[^0-9]/', '', $request->harga),
            'bankSampah_id' => $banksampahid,
            'kategori_id' => $request->kategori,
            'foto' => $newName,
            'status' => "Tersedia",
        ]);

        return redirect('/sampah')->with('success', 'Penambahan Sampah Berhasil');
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
        $kategori = Kategori::where('id', $sampah->kategori_id)->get();
        return view('banksampah.sampah.show', compact('sampah', 'kategori'));
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
        $kategori = Kategori::all();
        return view('banksampah.sampah.edit', compact('sampah', 'kategori'));
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

        $num = rand(1, 100);
        $basenamefile = str_replace(' ', '_', $request->name);

        $newName = "";
        $namaFoto = $sampah->foto;
        if ($request->hasFile('foto')) {
            if ($namaFoto != null || $namaFoto != '') {
                Storage::delete('foto/' . $namaFoto);
            }
            $extension = $request->file('foto')->getClientOriginalExtension();
            $newName = $basenamefile . $id . '&upd=' . $num . '.' . $extension;
            $request->file('foto')->storeAs('foto', $newName);
            $sampah->foto = $newName;
        }
        $sampah->nama_sampah = $request->name;
        $sampah->jumlah = $request->jumlah;
        $sampah->harga = preg_replace('/[^0-9]/', '', $request->harga);
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
        $sampah = Sampah::findOrFail($id);
        $sampah->status = "Diarsip";
        $sampah->save();
        return redirect()->route('sampah.index')->with('success', 'Data Sampah anda berhasil diarsip');

    }
}
