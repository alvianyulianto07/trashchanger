@extends('template.master')
@section('konten')
    <div>
        {{-- PRODUCT GRID --}}
        <div class="container mt-2">
            <div class="product-grid card mx-4 mb-3 p-3">
                @foreach ($cart as $item)
                    <div class="card item">
                        <img src="{{ asset('storage/foto/'. $item->foto) }}" class="card-img-top">
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
                @endforeach
            </div>
        </div>
    </div>
@endsection
