<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>

    <!-- Bootstrap -->
    <script src="{{ asset('assets/modules/jquery/jquery.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/global.css') }}">
    <!-- Styles -->
    <style>
        /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */
        html {
            line-height: 1.15;
            -webkit-text-size-adjust: 100%
        }

        body {
            margin: 0
        }

        a {
            background-color: transparent
        }

        [hidden] {
            display: none
        }

        html {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, Noto Sans, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
            line-height: 1.5
        }

        *,
        :after,
        :before {
            box-sizing: border-box;
            border: 0 solid #e2e8f0
        }

        a {
            color: inherit;
            text-decoration: inherit
        }

        svg,
        video {
            display: block;
            vertical-align: middle
        }

        video {
            max-width: 100%;
            height: auto
        }

        .bg-white {
            --tw-bg-opacity: 1;
            background-color: rgb(255 255 255 / var(--tw-bg-opacity))
        }

        .bg-gray-100 {
            --tw-bg-opacity: 1;
            background-color: rgb(243 244 246 / var(--tw-bg-opacity))
        }

        .border-gray-200 {
            --tw-border-opacity: 1;
            border-color: rgb(229 231 235 / var(--tw-border-opacity))
        }

        .border-t {
            border-top-width: 1px
        }

        .flex {
            display: flex
        }

        .grid {
            display: grid
        }

        .hidden {
            display: none
        }

        .items-center {
            align-items: center
        }

        .justify-center {
            justify-content: center
        }

        .font-semibold {
            font-weight: 600
        }

        .h-5 {
            height: 1.25rem
        }

        .h-8 {
            height: 2rem
        }

        .h-16 {
            height: 4rem
        }

        .text-sm {
            font-size: .875rem
        }

        .text-lg {
            font-size: 1.125rem
        }

        .leading-7 {
            line-height: 1.75rem
        }

        .mx-auto {
            margin-left: auto;
            margin-right: auto
        }

        .ml-1 {
            margin-left: .25rem
        }

        .mt-2 {
            margin-top: .5rem
        }

        .mr-2 {
            margin-right: .5rem
        }

        .ml-2 {
            margin-left: .5rem
        }

        .mt-4 {
            margin-top: 1rem
        }

        .ml-4 {
            margin-left: 1rem
        }

        .mt-8 {
            margin-top: 2rem
        }

        .ml-12 {
            margin-left: 3rem
        }

        .-mt-px {
            margin-top: -1px
        }

        .max-w-6xl {
            max-width: 72rem
        }

        .min-h-screen {
            min-height: 100vh
        }

        .overflow-hidden {
            overflow: hidden
        }

        .p-6 {
            padding: 1.5rem
        }

        .py-4 {
            padding-top: 1rem;
            padding-bottom: 1rem
        }

        .px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem
        }

        .pt-8 {
            padding-top: 2rem
        }

        .fixed {
            position: fixed
        }

        .relative {
            position: relative
        }

        .top-0 {
            top: 0
        }

        .right-0 {
            right: 0
        }

        .shadow {
            --tw-shadow: 0 1px 3px 0 rgb(0 0 0 / .1), 0 1px 2px -1px rgb(0 0 0 / .1);
            --tw-shadow-colored: 0 1px 3px 0 var(--tw-shadow-color), 0 1px 2px -1px var(--tw-shadow-color);
            box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)
        }

        .text-center {
            text-align: center
        }

        .text-gray-200 {
            --tw-text-opacity: 1;
            color: rgb(229 231 235 / var(--tw-text-opacity))
        }

        .text-gray-300 {
            --tw-text-opacity: 1;
            color: rgb(209 213 219 / var(--tw-text-opacity))
        }

        .text-gray-400 {
            --tw-text-opacity: 1;
            color: rgb(156 163 175 / var(--tw-text-opacity))
        }

        .text-gray-500 {
            --tw-text-opacity: 1;
            color: rgb(107 114 128 / var(--tw-text-opacity))
        }

        .text-gray-600 {
            --tw-text-opacity: 1;
            color: rgb(75 85 99 / var(--tw-text-opacity))
        }

        .text-gray-700 {
            --tw-text-opacity: 1;
            color: rgb(55 65 81 / var(--tw-text-opacity))
        }

        .text-gray-900 {
            --tw-text-opacity: 1;
            color: rgb(17 24 39 / var(--tw-text-opacity))
        }

        .underline {
            text-decoration: underline
        }

        .antialiased {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale
        }

        .w-5 {
            width: 1.25rem
        }

        .w-8 {
            width: 2rem
        }

        .w-auto {
            width: auto
        }

        .grid-cols-1 {
            grid-template-columns: repeat(1, minmax(0, 1fr))
        }

        @media (min-width:640px) {
            .sm\:rounded-lg {
                border-radius: .5rem
            }

            .sm\:block {
                display: block
            }

            .sm\:items-center {
                align-items: center
            }

            .sm\:justify-start {
                justify-content: flex-start
            }

            .sm\:justify-between {
                justify-content: space-between
            }

            .sm\:h-20 {
                height: 5rem
            }

            .sm\:ml-0 {
                margin-left: 0
            }

            .sm\:px-6 {
                padding-left: 1.5rem;
                padding-right: 1.5rem
            }

            .sm\:pt-0 {
                padding-top: 0
            }

            .sm\:text-left {
                text-align: left
            }

            .sm\:text-right {
                text-align: right
            }
        }

        @media (min-width:768px) {
            .md\:border-t-0 {
                border-top-width: 0
            }

            .md\:border-l {
                border-left-width: 1px
            }

            .md\:grid-cols-2 {
                grid-template-columns: repeat(2, minmax(0, 1fr))
            }
        }

        @media (min-width:1024px) {
            .lg\:px-8 {
                padding-left: 2rem;
                padding-right: 2rem
            }
        }

        @media (prefers-color-scheme:dark) {
            .dark\:bg-gray-800 {
                --tw-bg-opacity: 1;
                background-color: rgb(31 41 55 / var(--tw-bg-opacity))
            }

            .dark\:bg-gray-900 {
                --tw-bg-opacity: 1;
                background-color: rgb(17 24 39 / var(--tw-bg-opacity))
            }

            .dark\:border-gray-700 {
                --tw-border-opacity: 1;
                border-color: rgb(55 65 81 / var(--tw-border-opacity))
            }

            .dark\:text-white {
                --tw-text-opacity: 1;
                color: rgb(255 255 255 / var(--tw-text-opacity))
            }

            .dark\:text-gray-400 {
                --tw-text-opacity: 1;
                color: rgb(156 163 175 / var(--tw-text-opacity))
            }

            .dark\:text-gray-500 {
                --tw-text-opacity: 1;
                color: rgb(107 114 128 / var(--tw-text-opacity))
            }
        }
    </style>
</head>

<style>
    body {
        font-family: "Poppins";
        font-size: 14px;
        background: #26a745;
    }

    input::placeholder {
        font-size: 12px;
    }
</style>

<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="d-flex align-items-center justify-content-center vh-100">
                    <div class="card register" style="width: 800px">
                        <div class="d-flex align-items-center justify-content-center pt-3 pb-1">
                            <div class="card-body align-items-center mx-2">
                                <div class="d-flex justify-content-center mb-4">
                                    <span class="fw-bold fs-5" style="color: #26a745;">Daftar</span>
                                </div>
                                <div class="col m-0">
                                    <form action="{{ url('register') }}" method="POST" id="regForm"
                                        autocomplete="off" class="p-0 m-0">
                                        @csrf
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="name">Nama</label>
                                            <input class="form-control" id="name" name="name" type="text"
                                                value="{{ old('name') }}" placeholder="Masukkan Nama" />
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="email">Email</label>
                                            <input class="form-control" id="email" name="email" type="text"
                                                value="{{ old('email') }}" placeholder="Masukkan Email" />
                                            @if ($errors->has('email'))
                                                <span class="error font-error text-danger">Email wajib diisi!</span>
                                            @endif
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="no_hp">No HP</label>
                                            <input class="form-control" id="no_hp" name="no_hp" type="text"
                                                value="{{ old('no_hp') }}" placeholder="Masukkan No HP" />
                                            @if ($errors->has('no_hp'))
                                                <span class="error font-error text-danger">No HP wajib diisi!</span>
                                            @endif
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="address-input">Alamat</label>
                                            <input class="form-control map-input" id="address-input"
                                                name="address-input" type="text" value="{{ old('address-input') }}"
                                                placeholder="Masukkan Alamat" />
                                            @if ($errors->has('alamat'))
                                                <span class="error font-error text-danger">Alamat wajib diisi!</span>
                                            @endif
                                        </div>

                                        <div class="form-group mb-3">
                                            <div id="address-map-container" style="width:100%;height:400px; ">
                                                <div style="width: 100%; height: 100%" id="address-map"></div>
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="koordinat">Koordinat</label>
                                            <input class="form-control" id="koordinat" name="koordinat" type="text"
                                                value="{{ old('koordinat') }}" placeholder="Masukkan Koordinat" />
                                            @if ($errors->has('koordinat'))
                                                <span class="error font-error text-danger">Koordinat wajib diisi!</span>
                                            @endif
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label" for="inputPassword">Password</label>
                                            <input class="form-control" id="inputPassword" type="password"
                                                name="password" placeholder="Masukkan Password" />
                                            @if ($errors->has('password'))
                                                <span class="error font-error text-danger">Password wajib diisi!</span>
                                            @endif
                                        </div>
                                        <div class="form-group mb-4">
                                            <label class="form-label" for="inputPassword2">Konfirmasi Password</label>
                                            <input class="form-control" id="password_confirmation" type="password"
                                                name="password_confirmation"
                                                placeholder="Masukkan Password Konfirmasi" />
                                            @if ($errors->has('password_confirmation'))
                                                <span class="error font-error text-danger">Password tidak sama!</span>
                                            @endif
                                        </div>
                                        <div class="form-check mb-4">
                                            <input class="form-check-input" name="check" type="checkbox"
                                                id="check" />
                                            <label class="form-check-label" for="form2Example31"> Daftar Bank Sampah
                                            </label>
                                        </div>
                                        <div class="d-grid gap-2 mb-2">
                                            <button class="btn btn-success" type="submit">Daftar</button>
                                        </div>
                                        <div class="text-center">
                                            <p>Sudah punya akun? <a href="/login" style="color: #26a745;">Masuk</a>
                                            </p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

</div>


</div>
</div>
<script defer
    src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize">
</script>

<script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
<script>
    function initialize() {

        $('regForm').on('keyup keypress', function(e) {
            var keyCode = e.keyCode || e.which;
            if (keyCode === 13) {
                e.preventDefault();
                return false;
            }
        });
        const locationInputs = document.getElementsByClassName("map-input");

        const autocompletes = [];
        const geocoder = new google.maps.Geocoder;
        for (let i = 0; i < locationInputs.length; i++) {

            const input = locationInputs[i];
            // const fieldKey = input.id.replace("-input", "");
            // const isEdit = document.getElementById(fieldKey + "-latitude").value != '' && document.getElementById(
            //     fieldKey + "-longitude").value != '';

            // const latitude = parseFloat(document.getElementById(fieldKey + "-latitude").value) || -33.8688;
            // const longitude = parseFloat(document.getElementById(fieldKey + "-longitude").value) || 151.2195;

            const map = new google.maps.Map(document.getElementById('address-map'), {
                center: {
                    lat: 0,
                    lng: 0
                },
                zoom: 13
            });
            const marker = new google.maps.Marker({
                map: map,
                position: {
                    lat: 0,
                    lng: 0
                },
            });

            // marker.setVisible(isEdit);

            const autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.key = "address";
            autocompletes.push({
                input: input,
                map: map,
                marker: marker,
                autocomplete: autocomplete
            });
        }

        for (let i = 0; i < autocompletes.length; i++) {
            const input = autocompletes[i].input;
            const autocomplete = autocompletes[i].autocomplete;
            const map = autocompletes[i].map;
            const marker = autocompletes[i].marker;

            google.maps.event.addListener(autocomplete, 'place_changed', function() {
                marker.setVisible(false);
                const place = autocomplete.getPlace();

                geocoder.geocode({
                    'placeId': place.place_id
                }, function(results, status) {
                    if (status === google.maps.GeocoderStatus.OK) {
                        const lat = results[0].geometry.location.lat();
                        const lng = results[0].geometry.location.lng();
                        setLocationCoordinates(autocomplete.key, lat, lng);
                    }
                });

                if (!place.geometry) {
                    window.alert("No details available for input: '" + place.name + "'");
                    input.value = "";
                    return;
                }

                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17);
                }
                marker.setPosition(place.geometry.location);
                marker.setVisible(true);

            });
        }
    }

    function setLocationCoordinates(key, lat, lng) {
        var marker;
        var map;

        const latitudeField = document.getElementById(key + "-" + "latitude");
        const longitudeField = document.getElementById(key + "-" + "longitude");

        map = new google.maps.Map(document.getElementById('address-map'), {
            zoom: 10,
            center: {
                lat: lat,
                lng: lng
            },
            zoom: 13
        });

        marker = new google.maps.Marker({
            position: {
                lat: lat,
                lng: lng
            },
            map: map
        });

        map.addListener("click", (mapsMouseEvent) => {
            marker.setMap(null);

            var position = JSON.stringify(mapsMouseEvent.latLng.toJSON());
            var lat = JSON.parse(position).lat;
            var lng = JSON.parse(position).lng;

            const center = new google.maps.LatLng(lat, lng);
            map.panTo(center);

            marker = new google.maps.Marker({
                position: mapsMouseEvent.latLng,
                map: map
            });

            var latlng = new google.maps.LatLng(lat, lng);
            var geocoder = geocoder = new google.maps.Geocoder();
            geocoder.geocode({
                'latLng': latlng
            }, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[1]) {
                        var address = document.getElementById('address-input');
                        address.value = results[1].formatted_address;
                    }
                }
            });
        });
    }
</script>
{{-- <script>
    let geocoder;

    function initMap() {
        geocoder = new google.maps.Geocoder();
    }

    function getAlamat() {
        var address = document.getElementById('alamat').value;
        var koordinat = document.getElementById('koordinat');
        geocoder.geocode({
            'address': address
        }, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                koordinat.value = (results[0].geometry.location.lat() + " " + results[0].geometry.location
                    .lng());
            } else {
                alert('Geocode gagal karena : ' + status);
            }
        });
    };
    var address = document.getElementById('alamat');
    address.addEventListener('keyup', function(e) {
        getAlamat();
    })
</script> --}}
</body>

</html>
