@extends('template.master')
@section('konten')
    <div>
        {{-- PRODUCT GRID --}}
        <div class="container mt-2 card">
            <div class="row">
                <div class="col-9 m-0 p-0">
                    <div class="mb-3 p-3">
                        <h3>Keranjang</h3>
                        @foreach ($cart as $nama_banksampah => $toko)
                            <p class="toko-name">{{$nama_banksampah}}</p>
                            @foreach ($toko as $item)
                                <div class="item-keranjang mb-3">
                                    <div class="row align-items-center">
                                        <div class="col-1">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefault">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <img src="{{ asset('storage/foto/' . $item->foto) }}" class="card-img-top">
                                        </div>
                                        <div class="col-8">
                                            <p class="trash-name">Jumlah: {{ $item->jumlah_barang }}</p>
                                            <div class="m-2">
                                                <p class="trash-name">Nama barang: {{ $item->nama_sampah }}</p>
                                                <p class="cost">Harga satuan {{ $item->harga }}/kg</p>
                                                <p class="bank-name">Bank Sampah:
                                                    <strong>{{ $item->nama_banksampah }}</strong>
                                                </p>
                                                <p class="cost">{{ $item->total_harga }}</p>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
                <div class="col-3 m-0 p-0">
                    <div class="card m-3 p-3">
                        <p class="ringkasan-belanja">Ringkasan Belanja</p>
                        <div class="d-flex justify-content-between">
                            <p class="label-total-harga-cart" style="margin: 0; padding: 0;">Total Harga</p>
                            <input type="number" value="1.000" class="total-harga-cart">
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <p class="label-total-harga-cart-akhir" style="margin: 0; padding: 0;">Total Harga</p>
                            <input type="number" value="1.000" class="total-harga-cart-akhir">
                        </div>
                        <button class="btn btn-success btn-block mt-3">Beli (11)</button>
                    </div>
                </div>


            </div>


        </div>
    </div>
@endsection
