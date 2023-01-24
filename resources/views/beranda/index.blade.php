@extends('template.master')
@section('konten')
    <div>
        <!-- Just an image -->
        <nav class="navbar navbar-light bg-light px-5 justify-content-between">
            <div class="icon-left">
                <a href="" style="margin-right: 7px"><i class="fa-brands fa-facebook"></i></a>
                <a href="" style="margin-right: 7px"><i class="fa-brands fa-instagram "></i></a>
                <a href=""><i class="fa-brands fa-youtube"></i></a>
            </div>
            <a class="navbar-brand" href="#">
                TrashChanger
            </a>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdownMenuLink"
                    role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img (31).webp" class="rounded-circle"
                        height="22" alt="Avatar" loading="lazy" />
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <li>
                        <a class="dropdown-item" href="#">My profile</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">Settings</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">Logout</a>
                    </li>
                </ul>
            </li>

        </nav>
    </div>
@endsection
