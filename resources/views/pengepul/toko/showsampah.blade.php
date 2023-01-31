@extends('template.master')
@section('konten')
    <div>
        <hr>
        <div class="container px-5 mt-4">
            <div class="row">
                <div class="col-4">
                    <img class="rounded" src="{{ asset('assets/images/sampah1.jpg') }}" width="100%" alt="">
                </div>
                <div class="col-8">
                    @foreach ($sampah as $s)
                        <h3>{{ $s->nama_sampah }}</h3>
                        <p>Stok: <strong>{{ $s->jumlah }}</strong></p>
                        <p class="harga">{{ $s->harga }}/kg</p>
                        <hr>
                        <p>Lokasi Bank Sampah:</p>
                        <p>Jl. Kalimalang No.54, Lamongan, East Java</p>
                        <hr>
                        <div class="d-flex justify-content-end mb-3">
                            <div class="card p-2" style="width: 70%">
                                <p class="card-buy">Atur jumlah pembelian</p>
                                <div class="row px-2">
                                    <div class="col-3">
                                        <img class="rounded" src="{{ asset('assets/images/sampah1.jpg') }}" width="100%"
                                            alt="">
                                    </div>
                                    <div class="col-9">
                                        <p>Nama Item: <strong>{{ $s->nama_sampah }}</strong></p>
                                        <p>Kategori: <strong>{{ $s->kategori_id }}</strong></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row px-2">
                                    <div class="col-6">
                                        <input type="number" name="" id="">
                                        <p>Min pembelian 1kg</p>
                                    </div>
                                    <div class="col-6">
                                        <p>Stok: {{ $s->jumlah }}</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between px-3">
                                    <p>Total harga</p>
                                    <p>{{$s->harga}}</p>
                                </div>
                                <button class="btn btn-success btn-sm mb-2">Keranjang</button>
                                <button class="btn btn-outline-success btn-sm">Beli langsung</button>
                            </div>
                        </div>
                        
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
