@extends('template.master')
@section('konten')
    <div class="container mt-3">
        <h3 class="header-keranjang mt-2">Daftar Transaksi</h3>
        <div class="card">
            {{-- @foreach ($cart as $nama_banksampah => $toko) --}}
                <div class="row align-items-center">
                        <div class="toko-name-keranjang">Kotakku</div>
                    {{-- @foreach ($toko as $item) --}}
                        <div class="row align-items-center mb-3">
                            <div class="col-2 text-center">
                                <img src="{{ asset('storage/foto') }}" class="card-img-keranjang">
                            </div>
                            <div class="col-10 p-0">
                                <div class="m-2">
                                    <p class="trash-name-keranjang">Nama barang:
                                        {{-- {{ $item->nama_sampah }} --}}
                                    </p>
                                    <p class="cost-satuan-keranjang">Harga satuan 5000/kg
                                    </p>
                                    <input value="" name="item"
                                        id="item" class="cost-keranjang" readonly />
                                </div>
                                <div class="d-flex justify-content-end">
                                    <div class="d-flex justify-content-end">
                                        <div class="btn btn-link px-2"
                                            onclick="this.parentNode.querySelector('input[type=number]').stepDown(); totalCost();">
                                            <i class="fas fa-minus"></i>
                                        </div>

                                        <input id="item" min="1"
                                            name="item"
                                            value="" type="number"
                                            class="form-control form-control-barang-keranjang" />

                                        <div class="btn btn-link px-2"
                                            onclick="this.parentNode.querySelector('input[type=number]').stepUp(); totalCost();">
                                            <i class="fas fa-plus"></i>
                                        </div>
                                    </div>
                                    <button class="btn btn-sm btn-danger mx-3"><i class="far fa-trash-alt"
                                            style="margin-right: 5px"></i>Hapus</button>
                                </div>
                            </div>
                        </div>
                        </class=>
                    {{-- @endforeach --}}
                </div>
                <hr style="margin-top: 0">
            {{-- @endforeach --}}
        </div>
    </div>
@endsection
