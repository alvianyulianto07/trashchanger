<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Manajemen Bank Sampah | TrashChanger</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/modules/datatable/datatables.css')}}"/>
    <link rel="stylesheet" href="{{ asset('assets/modules/select2/dist/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/banksampah.css') }}">

    <script src="{{ asset('assets/modules/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/modules/datatable/datatables.js') }}"></script>
    <script src="{{ asset('assets/modules/popper.js') }}"></script>
    <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/modules/select2/dist/js/select2.min.js')}}"></script>
    <script src="{{ asset('assets/js/banksampah.js') }}"></script>

</head>

<style>
    body {
        font-family: "Poppins";
        font-size: 12px;
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
                    <div class="dropdown-menu dropdown-list">
                    </div>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Admin
                        </a>
                        <form action="/logout" method="POST">
                            @csrf
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                <button type="submit" class="dropdown-item">Logout</button>
                            </div>
                        </form>
                    </li>
                </ul>
            </nav>

            @include('banksampah.template.sidebar')

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
