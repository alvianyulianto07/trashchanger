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


        {{-- KONTEN DISINI --}}
        <div class="container card my-3">
            <div class="card mt-3">
                <div class="invoice">
                    <p>No.invoice</p>
                    <p>Tanggal Pembelian</p>
                </div>
                <div class="invoice">
                    <p>INI NOMER</p>
                    <p>{{$pembelian->tanggal}}</p>
                </div>
            </div>
            <div class="card mt-3">
                <p style="margin: 0">Detail Produk</p>
                @foreach ($alltransaksi as $banksampahid => $alltransaksibanksampah)
                    @foreach ($allbanksampah as $banksampah)
                        <p {{ $banksampah->id != $banksampahid ? 'hidden' : '' }}>
                            {{ $banksampah->nama_banksampah }}</p>
                    @endforeach
                    @foreach ($alltransaksibanksampah as $transaksi)
                        <div class="detail-produk card m-2">
                            <div class="row">
                                <div class="col-3">
                                    <img src="{{ asset('storage/foto') }}" class="card-img-pembelian">
                                </div>
                                <div class="col-9">
                                    <div class="row">
                                        <div class="col-8">
                                            <p>{{ $transaksi->nama_sampah }}</p>
                                            <p>{{ $transaksi->jumlah_barang }} x Rp. {{ $transaksi->harga_satuan }}/Kg
                                            </p>
                                            <p>{{ $transaksi->status }}</p>
                                        </div>
                                        <div class="col-4">
                                            <p>Total Harga</p>
                                            <p>Rp. {{ number_format($transaksi->total_harga, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
            <div class="card mt-3">
                <div class="rincian-pembayaran">
                    <div class="d-flex justify-content-between mx-5 my-2">
                        <h4 style="margin: 0">Total Belanja</h4>
                        <h4 style="margin: 0">Rp. {{ number_format($pembelian->total_harga, 0, ',', '.') }}</h4>
                    </div>
                </div>
            </div>
            <div class="card mt-3 mb-3">
                <div class="map m-3">
                    Rekomendasi Rute Pembelian
                    <div class="card">
                        <iframe class="mb-3"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15836.896465492711!2d112.17734576977537!3d-7.100003399999994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e778c56bba95239%3A0x1b5fbffeb58417f!2sUD.%20Bintang%20Motor!5e0!3m2!1sid!2sid!4v1675145505514!5m2!1sid!2sid"
                            width="100%" height="500px" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>

                </div>
            </div>
        </div>
        <script src="{{ asset('assets/modules/popper.js') }}"></script>
        <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.js') }}"></script>
        <script src="{{ asset('assets/modules/jquery/jquery.js') }}"></script>
</body>



</html>
