@extends('template.master')
@section('konten')
    <div class="container mt-3">
        <h3 class="header-keranjang mt-2">Daftar Transaksi</h3>
        <div class="card">
            {{-- @foreach ($cart as $nama_banksampah => $toko) --}}
            <div class="row align-items-center">
                <div class="toko-name-pembelian">Kotakku</div>
                {{-- @foreach ($toko as $item) --}}
                <div class="row align-items-center mb-3">
                    <div class="col-4 text-center">
                        <img src="{{ asset('storage/foto') }}" class="card-img-pembelian">
                    </div>
                    <div class="col-8 p-0">
                        <p class="status-pembelian">selesai</p>
                        <p class="trash-name-keranjang">Nama barang:
                            {{-- {{ $item->nama_sampah }} --}}
                        </p>
                        <p class="cost-satuan-keranjang">Harga satuan 5000/kg
                        </p>
                        <input value="10000" name="item" id="item" class="cost-keranjang" readonly />
                        <p style="margin: 0">3 produk</p>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-sm btn-success mx-3"><i class="far fa-eye"
                                    style="margin-right: 5px"></i>Lihat Transaksi</button>
                        </div>
                    </div>
                </div>
                </class=>
                {{-- @endforeach --}}
            </div>
            {{-- @endforeach --}}
        </div>
    </div>
@endsection
