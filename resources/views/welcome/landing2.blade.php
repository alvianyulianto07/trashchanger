<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>TrashChanger | Situs Jual Beli Sampah</title>
    <link rel="stylesheet" href="{{ asset('assets/landing/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/landing/vendors/owl.carousel/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/landing/vendors/owl.carousel/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/landing/vendors/aos/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/landing/vendors/jquery-flipster/css/jquery.flipster.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/landing/css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/landing/images/favicon.png') }}" />
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="50">
    <div id="mobile-menu-overlay"></div>
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">TrashChanger</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01"
                aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"><i class="mdi mdi-menu"> </i></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <div class="d-lg-none d-flex justify-content-between px-4 py-3 align-items-center">
                    <img src="{{ asset('assets/landing/images/logo-dark.svg') }}" class="logo-mobile-menu"
                        alt="logo">
                    <a href="javascript:;" class="close-menu"><i class="mdi mdi-close"></i></a>
                </div>
                <ul class="navbar-nav ml-auto align-items-center">
                    <li class="nav-item active">
                        <a class="nav-link" href="#home">Beranda <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#services">Fitur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#projects">Bank Sampah</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-success" href="/login">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="page-body-wrapper">
        <section id="home" class="home">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="main-banner">
                            <div class="d-sm-flex justify-content-between">
                                <div data-aos="zoom-in-up">
                                    <div class="banner-title">
                                        <h3 class="font-weight-medium">Selamat Datang di
                                            TrashChanger
                                        </h3>
                                    </div>
                                    <p class="mt-3">Situs jual beli sampah online

                                    </p>
                                    <a href="#" class="btn btn-success mt-3">Learn more</a>
                                </div>
                                <div class="mt-5 mt-lg-0">
                                    <img src="{{ asset('assets/landing/images/group.png') }}" alt="marsmello"
                                        class="img-fluid" data-aos="zoom-in-up">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="our-process" id="about">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6" data-aos="fade-up">
                        <h3 class="font-weight-medium text-dark">TrashChanger</h3>
                        <h5 class="text-dark mb-3">Situs Jual Beli Sampah</h5>
                        <p class="font-weight-medium mb-4">Adalah aplikasi yang memiliki fungsi sebagai <br>
                            tempat untuk melakukan transaksi sampah secara online.
                        </p>
                        <div class="d-flex justify-content-start mb-3">
                            <img src="{{ asset('assets/landing/images/tick.png') }}" alt="tick"
                                class="mr-3 tick-icon">
                            <p class="mb-0">Praktis dan Aman</p>
                        </div>
                        <div class="d-flex justify-content-start mb-3">
                            <img src="{{ asset('assets/landing/images/tick.png') }}" alt="tick"
                                class="mr-3 tick-icon">
                            <p class="mb-0">Bank Sampah Terintegrasi</p>
                        </div>
                        <div class="d-flex justify-content-start">
                            <img src="{{ asset('assets/landing/images/tick.png') }}" alt="tick"
                                class="mr-3 tick-icon">
                            <p class="mb-0">Didukung Rekomendasi Rute</p>
                        </div>
                    </div>
                    <div class="col-sm-6 text-right" data-aos="flip-left" data-aos-easing="ease-out-cubic"
                        data-aos-duration="2000">
                        <img src="{{ asset('assets/landing/images/idea.png') }}" alt="idea" class="img-fluid">
                    </div>
                </div>
            </div>
        </section>
        <section class="our-services" id="services">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h5 class="text-dark">Fitur Kami</h5>
                        <h3 class="font-weight-medium text-dark mb-5">Transaksi Sampah Online</h3>
                    </div>
                </div>
                <div class="row" data-aos="fade-up">
                    <div class="col-sm-3 text-center">
                        <div class="services-box" data-aos="fade-down" data-aos-easing="linear"
                            data-aos-duration="1500">
                            <img src="{{ asset('assets/landing/images/praktis.svg') }}"
                                alt="integrated-marketing" data-aos="zoom-in">
                            <h6 class="text-dark mb-3 mt-4 font-weight-medium">Praktis
                            </h6>
                            <p>Pengelolaan data dilakukan secara digital.
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-3 text-center">
                        <div class="services-box" data-aos="fade-down" data-aos-easing="linear"
                            data-aos-duration="1500">
                            <img src="{{ asset('assets/landing/images/aman.svg') }}"
                                alt="design-development" data-aos="zoom-in">
                            <h6 class="text-dark mb-3 mt-4 font-weight-medium">Aman
                            </h6>
                            <p>Keamanan data pengguna dan sistem pembayaran transaksi terjamin.
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-3 text-center">
                        <div class="services-box" data-aos="fade-down" data-aos-easing="linear"
                            data-aos-duration="1500">
                            <img src="{{ asset('assets/landing/images/integrasi.svg') }}"
                                alt="digital-strategy" data-aos="zoom-in">
                            <h6 class="text-dark mb-3 mt-4 font-weight-medium">Terintegrasi
                            </h6>
                            <p>Data bank sampah yang tergabung sudah terintegrasi sehingga memudahkan pemantauan
                                pengelolaan sampah.
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-3 text-center">
                        <div class="services-box  pb-lg-0" data-aos="fade-down" data-aos-easing="linear"
                            data-aos-duration="1500">
                            <img src="{{ asset('assets/landing/images/map.svg') }}"
                                alt="digital-marketing" data-aos="zoom-in">
                            <h6 class="text-dark mb-3 mt-4 font-weight-medium">Rekomendasi Rute
                            </h6>
                            <p>Rekomendasi rute paling efisien untuk pengambilan sampah.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="our-projects" id="projects">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-sm-12">
                        <div class="d-sm-flex justify-content-center align-items-center mb-2">
                            <h3 class="font-weight-medium text-dark ">Mari Bergabung Bersama Kami</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-5" data-aos="fade-up">
                <div class="container">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3959.0496516624244!2d112.40608971420274!3d-7.120244671801697!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e77f0b5bba55409%3A0x8739f313495b22c4!2sUD.%20BINTANG%20MOTOR!5e0!3m2!1sid!2sid!4v1672371321591!5m2!1sid!2sid"
                        width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>

            </div>
            <div class="container">
                <div class="row pt-5 mt-5 pb-5 mb-5">
                    <div class="col-sm-3">
                        <div class="d-flex py-3 my-3 my-lg-0 justify-content-center" data-aos="fade-down">
                            <img src="{{ asset('assets/landing/images/satisfied-client.svg') }}"
                                alt="satisfied-client" class="mr-3">
                            <div>
                                <h4 class="font-weight-bold text-dark mb-0"><span class="scVal">0</span>%</h4>
                                <h5 class="text-dark mb-0">Satisfied clients</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="d-flex py-3 my-3 my-lg-0 justify-content-center" data-aos="fade-up">
                            <img src="{{ asset('assets/landing/images/finished-project.svg') }}"
                                alt="satisfied-client" class="mr-3">
                            <div>
                                <h4 class="font-weight-bold text-dark mb-0"><span class="fpVal">0</span></h4>
                                <h5 class="text-dark mb-0">Finished Project</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="d-flex py-3 my-3 my-lg-0 justify-content-center" data-aos="fade-down">
                            <img src="{{ asset('assets/landing/images/team-members.svg') }}" alt="Team Members"
                                class="mr-3">
                            <div>
                                <h4 class="font-weight-bold text-dark mb-0"><span class="tMVal">0</span></h4>
                                <h5 class="text-dark mb-0">Team Members</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="d-flex py-3 my-3 my-lg-0 justify-content-center" data-aos="fade-up">
                            <img src="{{ asset('assets/landing/images/our-blog-posts.svg') }}" alt="Our Blog Posts"
                                class="mr-3">
                            <div>
                                <h4 class="font-weight-bold text-dark mb-0"><span class="bPVal">0</span></h4>
                                <h5 class="text-dark mb-0">Our Blog Posts</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <footer class="footer">
        <div class="footer-bottom" style="background-color: #26a745;">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <p class="navbar-brand" href="#">TrashChanger</p>
                        <p class="mb-0 text-small pt-1">© 2022 <a href="#" class="text-white"
                                target="_blank">TrashChanger</a>. All rights reserved.</p>
                    </div>
                    <div>
                        <div class="d-flex">
                            <p href="#" class="text-small text-white mx-2 footer-link">+62 812-3456-7898 </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="{{ asset('assets/landing/vendors/base/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('assets/landing/vendors/owl.carousel/js/owl.carousel.js') }}"></script>
    <script src="{{ asset('assets/landing/vendors/aos/js/aos.js') }}"></script>
    <script src="{{ asset('assets/landing/vendors/jquery-flipster/js/jquery.flipster.min.js') }}"></script>
    <script src="{{ asset('assets/landing/js/template.js') }}"></script>
</body>

</html>
