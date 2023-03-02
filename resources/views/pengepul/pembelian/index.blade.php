@extends('template.master')
@section('konten')
    <div class="container mt-3">
        <h3 class="header-keranjang mt-2">Daftar Transaksi</h3>
        <div class="card">
            @foreach ($allpembelian as $pembelianid => $pembelian)
                <div>
                    <div class="row align-items-center">
                        @foreach ($pembelian as $nama_banksampah => $transaksi)
                            @if ($loop->first)
                                <div class="toko-name-pembelian">{{ $nama_banksampah }}</div>
                                @foreach ($transaksi as $sampah)
                                    @if ($loop->first)
                                        <div class="row align-items-center mb-3">
                                            <div class="col-4 text-center">
                                                <img src="{{ asset('storage/foto/' . $sampah->foto) }}"
                                                    class="card-img-pembelian">
                                            </div>
                                            <div class="col-8 p-0">
                                                <p class="status-pembelian">{{ $sampah->status }}</p>
                                                <p class="trash-name-keranjang">
                                                    {{-- {{ $pembelian->nama_sampah }} --}}
                                                </p>
                                                <p class="cost-satuan-keranjang">Harga satuan 5000/kg
                                                </p>
                                                <input value="Rp. {{ number_format($sampah->total_harga, 0, ',', '.') }}"
                                                    name="item" id="item" class="cost-keranjang" readonly />
                                                <p style="margin: 0">{{ $loop->count }} produk</p>
                                                <div class="d-flex justify-content-end">
                                                    <a href="{{ route('pembelian.show', $pembelianid) }}"
                                                        class="btn btn-sm btn-success mx-3"><i class="far fa-eye"
                                                            style="margin-right: 5px"></i>Lihat
                                                        Transaksi</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </div>
                </div>
                <hr>
            @endforeach
        </div>
    </div>
@endsection
