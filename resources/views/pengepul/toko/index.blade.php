@extends('template.master')
@section('konten')
    <div>

        {{-- CAROUSEL --}}
        <div class="container p-3">
            <div id="carouselExampleCaptions" class="carousel slide mx-4" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('assets/images/sampah1.jpg') }}" style="width:400px;height:400px;"
                            class="d-block w-100" alt="1">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('assets/images/sampah2.jpg') }}" style="width:400px;height:400px;"
                            class="d-block w-100" alt="2">

                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('assets/images/sampah3.jpg') }}" style="width:400px;height:400px;"
                            class="d-block w-100" alt="3">

                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        {{-- PRODUCT GRID --}}
        <div class="container mt-2">
            <div class="product-grid card mx-4 mb-3 p-3">
                @foreach ($sampah as $item)
                <a href="{{route('beranda.showsampah', ['id'=>1, 'idsampah'=>$item->id] )}}" class="card item">
                    <img src="{{ asset('assets/images/sampah2.jpg') }}" class="card-img-top">
                    <div class="m-2">
                        @foreach ($kategori as $k)
                            <h3 class="kategori"{{$k->id != $item->kategori_id ? 'hidden' : ''}}>{{$k->nama_kategori}}</h3>
                        @endforeach
                        <p class="trash-name">{{$item->nama_sampah}}</p>
                        <p class="cost">{{$item->harga}}/kg</p>
                        @foreach ($banksampah as $b)
                            <p class="bank-name"{{$b->id != $item->bankSampah_id ? 'hidden' : ''}}>Bank Sampah: <strong>{{$b->nama_banksampah}}</strong></p>
                        @endforeach
                    </div>
                </a>
                @endforeach
            </div>
        </div>

        {{-- FOOTER --}}
        <footer class="bg-light text-center text-lg-start">
            <!-- Copyright -->
            <div class="text-center p-3" style="background-color: #26a745; color: antiquewhite;">
                © 2022 Copyright:
                <a class="text-light" href="/">Trashchanger.com</a>
            </div>
            <!-- Copyright -->
        </footer>
    </div>
@endsection
