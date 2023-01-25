<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Situs Jual Beli Sampah | TrashChanger</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/banksampah.css') }}">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.css') }}">

    <script src="{{ asset('assets/modules/datatable/datatable.min.js') }}"></script>
    <script src="{{ asset('assets/modules/popper.js') }}"></script>
    <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/modules/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/banksampah.js') }}"></script>



</head>

<style>
    body {
        font-family: "Poppins";
    }
</style>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <nav class="navbar navbar-expand-lg main-navbar justify-content-between">
                <div class="navbar-bg"></div>
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i
                                    class="fas fa-bars"></i></a></li>
                    </ul>
                </form>
                <ul class="navbar-nav">
                    <div class="dropdown-menu dropdown-list dropdown-menu-right">
                    </div>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Admin
                        </a>
                        <form action="/logout" method="POST">
                            @csrf
                            <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdownMenuLink">
                                <button type="submit" class="dropdown-item">Logout</button>
                            </div>
                        </form>
                    </li>
                </ul>
            </nav>

            @include('banksampahtemplate.sidebar')

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="container-fluid p-0">
                        @yield('konten')
                    </div>
                </section>
            </div>


        </div>
    </div>
</body>



</html>
