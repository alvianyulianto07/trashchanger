<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Situs Jual Beli Sampah | TrashChanger</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.css') }}">



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
                        Admin
                    </a>
                    <form action="/logout" method="POST">
                        @csrf
                        <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="/profil">Profile</a>
                            <a class="dropdown-item" href="/pengaturan">Settings</a>
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
                        TrashChanger
                    </div>
                </div>
                <div class="col-8">
                    <form action="{{ route('beranda.search') }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Cari sampah" name="text"
                                id="text">
                            <button class="btn btn-outline-search" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>
                <div class="col d-flex justify-content-center">
                    <a href="/keranjang"><i class="fas fam fa-cart-shopping"></i></a>
                    <a href="/pembelian"><i class="fas fam fa-receipt"></i></a>
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
        @yield('konten')
    </div>

    <script src="{{ asset('assets/modules/popper.js') }}"></script>
    <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/modules/jquery/jquery.js') }}"></script>
</body>



</html>
