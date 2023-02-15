@extends('template.master')
@section('konten')
    <div class="container">
        <div class="card mt-2">
            <div class="row align-items-center py-2">
                <div class="col-2 text-center">
                    <img src="{{ asset('assets/images/sampah1.jpg') }}" alt="" class="img-toko">
                </div>
                <div class="col-10">
                        <p class="nama-toko-show">{{$banksampah->nama_banksampah}}</p>
                        <p class="alamat-toko-show">Alamat</p>
                        <button class="btn btn-sm btn-success">Chat penjual</button>
                </div>
            </div>
        </div>
        <div class="container card mt-3 p-0">
            <div class="product-grid p-3">
                <div class="card item">
                    <img src="{{ asset('assets/images/sampah2.jpg') }}" class="card-img-top">
                    <div class="m-2">
                        <h3 class="kategori">Kategori</h3>
                        <p class="cost">Rp. 25.000,00</p>
                        <p class="bank-name">Nama Bank Sampah</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
