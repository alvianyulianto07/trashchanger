@extends('template.master')
@section('konten')
    <div class="container">
        <div class="card mt-2">
            <div class="row align-items-center py-2">
                <div class="col-2 text-center">
                    <img src="{{ asset('assets/images/sampah1.jpg') }}" alt="" class="img-toko">
                </div>
                <div class="col-10">
                    <p class="nama-toko-show">{{ $banksampah->nama_banksampah }}</p>
                    <p class="alamat-toko-show">Alamat</p>
                    <button class="btn btn-sm btn-success">Chat penjual</button>
                </div>
            </div>
        </div>
        <div class="container card mt-3 p-0">
            <div class="product-grid p-3">
                @foreach ($sampah as $item)
                    @if ($banksampah->id == $item->bankSampah_id)
                        <a href="{{ route('beranda.showsampah', ['id' => $banksampah->id, 'idsampah' => $item->id]) }}"
                            class="card item">
                            <img src="{{ asset('storage/foto/' . $item->foto) }}" class="card-img-top">
                            <div class="m-2">
                                @foreach ($kategori as $k)
                                    <h3 class="kategori"{{ $k->id != $item->kategori_id ? 'hidden' : '' }}>
                                        {{ $k->nama_kategori }}</h3>
                                @endforeach
                                <p class="trash-name">{{ $item->nama_sampah }}</p>
                                <p class="cost">{{ $item->harga }}/kg</p>
                                <p class="bank-name">Bank Sampah:
                                    <strong>{{ $banksampah->nama_banksampah }}</strong>
                                </p>

                            </div>
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection
