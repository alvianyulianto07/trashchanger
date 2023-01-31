@extends('template.master')
@section('konten')
    {{-- PRODUCT GRID --}}
    <div class="container mt-2">
        <div class="card mx-4 mb-3 p-3">
            @if (count($sampah)===0)
                    <div class="text-center">
                        
                    </div>
                @else
            <div class="product-grid ">
                    @foreach ($sampah as $item)
                        <a href="{{ route('beranda.showsampah', ['id' => 1, 'idsampah' => $item->id]) }}" class="card item">
                            <img src="{{ asset('assets/images/sampah2.jpg') }}" class="card-img-top">
                            <div class="m-2">
                                @foreach ($kategori as $k)
                                    <h3 class="kategori"{{ $k->id != $item->kategori_id ? 'hidden' : '' }}>
                                        {{ $k->nama_kategori }}</h3>
                                @endforeach
                                <p class="trash-name">{{ $item->nama_sampah }}</p>
                                <p class="cost">{{ $item->harga }}/kg</p>
                                @foreach ($banksampah as $b)
                                    <p class="bank-name"{{ $b->id != $item->bankSampah_id ? 'hidden' : '' }}>Bank Sampah:
                                        <strong>{{ $b->nama_banksampah }}</strong></p>
                                @endforeach
                            </div>
                        </a>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
