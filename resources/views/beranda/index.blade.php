@extends('template.master')
@section('konten')
    <div>
        {{-- NAVBAR --}}
        <nav class="navbar navbar-light bg-light px-5 justify-content-between align-items-center">
            <div class="container-fluid">
                <div class="icon-left">
                    <a href="" style="margin-right: 7px"><i class="fa-brands fa-facebook"></i></a>
                    <a href="" style="margin-right: 7px"><i class="fa-brands fa-instagram "></i></a>
                    <a href=""><i class="fa-brands fa-youtube"></i></a>
                </div>
                <a class="navbar-brand" href="#">
                    TrashChanger
                </a>
                <li class="nav-item dropdown dropdown-profile">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img (31).webp" class="rounded-circle"
                            height="30" alt="Avatar" loading="lazy" />
                        Admin
                    </a>
                    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Profile</a>
                        <a class="dropdown-item" href="#">Settings</a>
                        <a class="dropdown-item" href="#">Logout</a>
                    </div>
                </li>
            </div>
        </nav>

        {{-- HEADER SEARCH --}}
        <div class="container my-4">
            <div class="row align-items-center">
                <div class="col">
                    <div class="text-center">
                        TrashChanger
                    </div>
                </div>
                <div class="col-8">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Cari sampah" aria-label="Cari sampah"
                            aria-describedby="button-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-outline-search" type="button" id="button-addon2"><i
                                    class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col d-flex justify-content-center">
                    <a href=""><i class="fas fam fa-cart-shopping"></i></a>
                    <a href=""><i class="fas fam fa-receipt"></i></a>
                </div>
            </div>
        </div>

        <hr>

        {{-- KATEGORI --}}
        <div class="container px-5 justify-content-center">
            <div class="row kategori" style="padding: 0 150px">
                <div class="col text-center item-kategori">Plastik</div>
                <div class="col text-center item-kategori">Botol</div>
                <div class="col text-center item-kategori">Kertas</div>
                <div class="col text-center item-kategori">Kaca</div>
                <div class="col text-center item-kategori">Karet</div>
                <div class="col text-center item-kategori">Kardus</div>
            </div>
        </div>

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
        <div class="container">
            <div class="card">

            </div>
        </div>

    </div>
@endsection
