<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Situs Jual Beli Sampah | TrashChanger</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"> --}}

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.css') }}">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
</head>

<style>
    body {
        font-family: "Poppins";
    }
</style>

<body>
    <div>
        {{-- NAVBAR --}}
        <nav class="navbar navbar-light bg-light px-5 justify-content-between align-items-center">
            <div class="container-fluid">
                <div class="icon-left">
                    <a href="" style="margin-right: 7px"><i class="fa-brands fa-facebook"></i></a>
                    <a href="" style="margin-right: 7px"><i class="fa-brands fa-instagram "></i></a>
                    <a href=""><i class="fa-brands fa-youtube"></i></a>
                </div>
                <a class="navbar-brand" href="/beranda">
                    TrashChanger
                </a>
                <li class="nav-item dropdown dropdown-profile">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img (31).webp" class="rounded-circle"
                            height="30" alt="Avatar" loading="lazy" />
                            {{ Auth::user()->nama  }}
                    </a>
                    <form action="/logout" method="POST">
                        @csrf
                        <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdownMenuLink">
                            <!-- <a class="dropdown-item" href="/profil">Profile</a>
                            <a class="dropdown-item" href="/pengaturan">Settings</a> -->
                            <button type="submit" class="dropdown-item">Logout</button>
                        </div>
                    </form>
                </li>
            </div>
        </nav>

        {{-- HEADER SEARCH --}}
        <div class="container my-4">
            <div class="row align-items-center">
                <div class="col">
                    <div class="text-center">
                        <a style="text-decoration: none; color:black;" href="/beranda">TrashChanger</a>
                    </div>
                </div>
                <div class="col-8">
                    <form action="{{ route('beranda.search') }}" method="POST">
                        @csrf
                        <div class="input-group">
                            @if ($searchquery != "")
                                <input type="text" class="form-control" placeholder="Cari sampah" name="searchquery"
                                    id="searchquery" value="{{ $searchquery }}">
                            @else
                                <input type="text" class="form-control" placeholder="Cari sampah" name="searchquery"
                                    id="searchquery">
                            @endif
                            <input type="text" class="form-control" placeholder="Cari sampah" name="searchtype"
                                id="searchtype" value="search" hidden>
                            <button class="btn btn-outline-search" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>
                <div class="col d-flex justify-content-center">
                    <a href="/keranjang"><i class="fas fam fa-cart-shopping"></i></a>
                    <a href="/pembelian"><i class="fas fam fa-receipt"></i></a>

                    <form action="{{ route('beranda.laporan') }}" method="POST">
                        @csrf
                        <input type="text" name="year" id="year" value="all" hidden>
                        <input type="text" name="month" id="month" value="all" hidden>
                        <button class="text-center border-0 bg-transparent" type="submit" ><i class="fas fam fa-chart-simple"></i></button>
                    </form>
                    {{-- <a href="/laporan"><i class="fas fam fa-chart-simple"></i></a> --}}
                </div>
            </div>
        </div>

        <hr>

        {{-- KATEGORI --}}
        <div class="container px-5 justify-content-center">

                <div class="row kategori" style="padding: 0 150px">
                    <div class="col text-center item-kategori">
                        <form action="{{ route('beranda.search') }}" method="POST">
                            @csrf
                            <input type="text" class="form-control" placeholder="Cari sampah" name="filterquery"
                                id="filterquery" value="Plastik" hidden>
                            <input type="text" class="form-control" placeholder="Cari sampah" name="searchtype"
                                id="searchtype" value="filter" hidden>
                            <button class="col text-center item-kategori border-0 bg-transparent" type="submit" >Plastik</button>
                        </form>
                    </div>
                    <div class="col text-center item-kategori">
                        <form action="{{ route('beranda.search') }}" method="POST">
                            @csrf
                                <input type="text" class="form-control" placeholder="Cari sampah" name="filterquery"
                                    id="filterquery" value="Botol" hidden>
                                <input type="text" class="form-control" placeholder="Cari sampah" name="searchtype"
                                    id="searchtype" value="filter" hidden>
                                <button class="col text-center item-kategori border-0 bg-transparent" type="submit" >Botol</button>
                        </form>
                    </div>
                    <div class="col text-center item-kategori">
                        <form action="{{ route('beranda.search') }}" method="POST">
                            @csrf
                            <input type="text" class="form-control" placeholder="Cari sampah" name="filterquery"
                                id="filterquery" value="Kertas" hidden>
                            <input type="text" class="form-control" placeholder="Cari sampah" name="searchtype"
                                id="searchtype" value="filter" hidden>
                            <button class="col text-center item-kategori border-0 bg-transparent" type="submit" >Kertas</button>
                    
                        </form>
                    </div>
                    <div class="col text-center item-kategori">
                        <form action="{{ route('beranda.search') }}" method="POST">
                            @csrf
                            <input type="text" class="form-control" placeholder="Cari sampah" name="filterquery"
                                id="filterquery" value="Kaca" hidden>
                            <input type="text" class="form-control" placeholder="Cari sampah" name="searchtype"
                                id="searchtype" value="filter" hidden>
                            <button class="col text-center item-kategori border-0 bg-transparent" type="submit" >Kaca</button>
                        </form>
                    </div>
                    <div class="col text-center item-kategori">
                        <form action="{{ route('beranda.search') }}" method="POST">
                            @csrf
                            <input type="text" class="form-control" placeholder="Cari sampah" name="filterquery"
                                id="filterquery" value="Karet" hidden>
                            <input type="text" class="form-control" placeholder="Cari sampah" name="searchtype"
                                id="searchtype" value="filter" hidden>
                            <button class="col text-center item-kategori border-0 bg-transparent" type="submit" >Karet</button>
                        </form>
                    </div>
                    <div class="col text-center item-kategori">
                        <form action="{{ route('beranda.search') }}" method="POST">
                            @csrf
                            <input type="text" class="form-control" placeholder="Cari sampah" name="filterquery"
                                id="filterquery" value="Kardus" hidden>
                            <input type="text" class="form-control" placeholder="Cari sampah" name="searchtype"
                                id="searchtype" value="filter" hidden>
                            <button class="col text-center item-kategori border-0 bg-transparent" type="submit" >Kardus</button>
                        </form>
                    </div>
                </div>
        </div>
        @yield('konten')
    </div>

    <script src="{{ asset('assets/modules/popper.js') }}"></script>
    <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/modules/jquery/jquery.js') }}"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script> --}}
</body>



</html>
