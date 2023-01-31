@extends('template.master')
@section('konten')
    <div>
        <hr>
        <div class="container mt-4">
            <div class="row">
                <div class="col-4">
                    <img class="rounded" src="{{ asset('assets/images/sampah1.jpg') }}" width="100%" alt="">
                </div>
                <div class="col-5">
                    <h3 style="margin: 0">{{ $sampah->nama_sampah }}</h3>
                    <p>Stok: <strong>{{ $sampah->jumlah }}</strong></p>
                    <p class="harga-display">{{ $sampah->harga }}/kg</p>
                    <hr>
                    <p style="margin: 0">Nama Bank Sampah: <strong>Kotakku</strong></p>
                    <p style="margin: 0">Alamat: <strong>Jl. Kalimalang No.54, Lamongan, East Java</strong></p>
                    <hr>
                    <iframe class="mb-3" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15836.896465492711!2d112.17734576977537!3d-7.100003399999994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e778c56bba95239%3A0x1b5fbffeb58417f!2sUD.%20Bintang%20Motor!5e0!3m2!1sid!2sid!4v1675145505514!5m2!1sid!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="col-3">
                    <div class="card p-2">
                        <p class="card-buy">Atur jumlah pembelian</p>
                        <div class="row px-2">
                            <div class="col-5">
                                <img class="rounded" src="{{ asset('assets/images/sampah1.jpg') }}" width="100%"
                                    alt="">
                            </div>
                            <div class="col-7">
                                <p class="deskripsi-pembelian">Nama Item: <strong>{{ $sampah->nama_sampah }}</strong></p>
                                <p class="deskripsi-pembelian">Kategori: <strong>{{ $sampah->kategori_id }}</strong></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row px-2">
                            <div class="col-7">
                                <input class="input-jumlah-barang" type="number" name="" id="">
                                <p class="minimum-buy">min pembelian 1kg</p>
                            </div>
                            <div class="col-5 m-0 p-0">
                                <p>Stok: <strong>{{ $sampah->jumlah }}</strong></p>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between px-2 align-items-center">
                            <p class="label-total-harga">Total harga</p>
                            <p class="total-harga">{{ $sampah->harga }}</p>
                        </div>
                        <button class="btn btn-success btn-sm mb-2">Keranjang</button>
                        <button class="btn btn-outline-success btn-sm">Beli langsung</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
