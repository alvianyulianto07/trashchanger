<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>TrashChanger</title>

        {{-- Scripts --}}
        <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js')}}"></script>
        <script src="{{ asset('assets/modules/popper.js')}}"></script>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/css/landing.css')}}">
    </head>
    <body>
        <div class="wrapper">
            <!-- Responsive navbar-->
            <nav class="navbar navbar-expand-lg navbar-dark bg-success">
                <div class="container">
                    <a class="navbar-brand" href="#">TrashChanger</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item"><a class="nav-link" aria-current="page" href="#">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Login</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Daftar</a></li>
                            {{-- <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Dropdown</a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><hr class="dropdown-divider" /></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </li> --}}
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- Page content-->
            <div class="container">
                <div class="text-center mt-5">
                    {{-- Carousel --}}
                    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                          <div class="carousel-item active">
                            <img src="{{ asset('assets/images/sampah1.jpg')}}" style="width:500px;height:500px;" class="d-block w-100" alt="1">
                            <div class="carousel-caption d-none d-md-block">
                              <h5>First slide label</h5>
                              <p>Some representative placeholder content for the first slide.</p>
                            </div>
                          </div>
                          <div class="carousel-item">
                            <img src="{{ asset('assets/images/sampah2.jpg')}}" style="width:500px;height:500px;" class="d-block w-100" alt="2">
                            <div class="carousel-caption d-none d-md-block">
                              <h5>Second slide label</h5>
                              <p>Some representative placeholder content for the second slide.</p>
                            </div>
                          </div>
                          <div class="carousel-item">
                            <img src="{{ asset('assets/images/sampah3.jpg')}}" style="width:500px;height:500px;" class="d-block w-100" alt="3">
                            <div class="carousel-caption d-none d-md-block">
                              <h5>Third slide label</h5>
                              <p>Some representative placeholder content for the third slide.</p>
                            </div>
                          </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    {{-- Definisi --}}
                    <div class="m-4">
                        <h1>TrashChanger</h1>
                        <p>TrashChanger adalah Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fuga cum optio impedit. Suscipit ab similique doloremque, nam distinctio blanditiis magnam a nisi et in officiis enim maxime beatae unde repellendus?</p>
                    </div>
                    {{-- Map --}}
                    <div class="my-5">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3959.0496516624244!2d112.40608971420274!3d-7.120244671801697!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e77f0b5bba55409%3A0x8739f313495b22c4!2sUD.%20BINTANG%20MOTOR!5e0!3m2!1sid!2sid!4v1672371321591!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    
                </div>
            </div>
            {{-- Footer --}}
            <section class="">
                <!-- Footer -->
                <footer class="text-center text-white bg-success">
                  <!-- Grid container -->
                  <div class="container p-4 pb-0">
                    <!-- Section: CTA -->
                    <section class="">
                      <p class="d-flex justify-content-center align-items-center">
                        <span class="me-3">Daftar sekarang!</span>
                        <button type="button" class="btn btn-outline-light btn-rounded">
                          Register
                        </button>
                      </p>
                    </section>
                    <!-- Section: CTA -->
                  </div>
                  <!-- Grid container -->
              
                  <!-- Copyright -->
                  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
                    © 2022 Copyright:
                    <a class="text-white" href="#">TrashChanger.com</a>
                  </div>
                  <!-- Copyright -->
                </footer>
                <!-- Footer -->
              </section>
        </div>
    </body>
</html>
