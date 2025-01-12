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
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

    <script defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initMap" async defer></script>
    </script>
    <script>
    function initMap() {
        
        const points = @json($points);

        const new_points = []

        // console.log(points);

        // Calculate the center of the map
        let latSum = 0;
        let lngSum = 0;

        points.forEach(point => {
            latSum += point[0];
            lngSum += point[1];

            new_points.push({lat: point[0], lng: point[1]})
        });

        const centerLat = latSum / points.length;
        const centerLng = lngSum / points.length;
        
        const mapCenter = { lat: centerLat, lng: centerLng };

        // // Initialize the map
        const map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: mapCenter, // Center the map based on the average of the points
        });

        // Initialize the Directions service and renderer
        const directionsService = new google.maps.DirectionsService();
        // const directionsRenderer = new google.maps.DirectionsRenderer();
        // directionsRenderer.setMap(map);
        const directionsRenderer = new google.maps.DirectionsRenderer({
            map: map,
            suppressMarkers: true // Prevent default markers
        });

        // Extract origin, destination, and waypoints
        const origin = new_points[0];
        const destination = new_points[points.length - 1];
        const waypoints = new_points.slice(1, -1).map(function (point) {
            return {
                location: point,
                stopover: true
            };
        });

        const originIcon = {
            path: "M12 2C8.13 2 5 5.13 5 9c0 3.9 3 7.69 6.39 11.53.37.43.89.67 1.42.67.53 0 1.05-.24 1.42-.67C16 16.69 19 12.9 19 9c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5s2.5 1.12 2.5 2.5S13.38 11.5 12 11.5z", // SVG path for the "place" marker
            fillColor: "blue",    // Color for origin
            fillOpacity: 1,       // Fill opacity
            scale: 1.5,           // Adjust size of the marker
            strokeWeight: 1,      // Border thickness
            strokeColor: "white"  // Border color
        };

        const destinationIcon = {
            path: "M12 2C8.13 2 5 5.13 5 9c0 3.9 3 7.69 6.39 11.53.37.43.89.67 1.42.67.53 0 1.05-.24 1.42-.67C16 16.69 19 12.9 19 9c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5s2.5 1.12 2.5 2.5S13.38 11.5 12 11.5z", // Same SVG path
            fillColor: "red",     // Color for destination
            fillOpacity: 1,       // Fill opacity
            scale: 1.5,           // Adjust size of the marker
            strokeWeight: 1,      // Border thickness
            strokeColor: "white"  // Border color
        };


        // Request route from Directions service
        directionsService.route(
            {
                origin: origin,
                destination: destination,
                waypoints: waypoints,
                travelMode: google.maps.TravelMode.DRIVING,
            }, function(response, status) {
                if (status === google.maps.DirectionsStatus.OK) {
                    directionsRenderer.setDirections(response);

                    // Custom marker for origin
                    new google.maps.Marker({
                        position: origin,
                        map: map,
                        label: { text: 'O', color: 'white', fontWeight: 'bold' }, // Origin label
                        icon: originIcon
                    });

                    // Custom marker for each waypoint
                    waypoints.forEach((waypoint, index) => {
                        new google.maps.Marker({
                            position: waypoint.location,
                            map: map,
                            label: `W${index + 1}`  // Waypoint label (W1, W2, ...)
                        });
                    });

                    // Custom marker for destination
                    new google.maps.Marker({
                        position: destination,
                        map: map,
                        label: { text: 'D', color: 'white', fontWeight: 'bold' }, // Destination label
                        icon: destinationIcon
                    });


                    // Extract and log the steps
                    const steps = response.routes[0].legs.flatMap(leg => leg.steps.map(step => step.instructions));
                    steps.forEach((step, index) => {
                        const div = document.createElement("div");
                        div.innerHTML = step;
                        console.log(`${index + 1}. ${div.textContent || div.innerText || ""}`);
                    });
                } else {
                    console.error('Directions request failed due to ' + status);
                }
            }
        );
    }
</script>
    <style>
        #map {
            height: 500px;
            width: 100%;
        }
    </style>
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
            <h4 class="text-center mt-2 header-detail-transaksi" style="margin: 0">Detail Transaksi</h4>
            <div class="card mt-3">
                <div class="row p-3">
                    <div class="col-2">
                        <p class="invoice">No.invoice</p>
                        <p class="invoice">Tanggal Pembelian</p>
                    </div>
                    <div class="col-10">
                        <p class="invoice-nomer">: {{ $pembelian->num_invoice }}</p>
                        <p class="invoice-data">: {{ $pembelian->tanggal }}</p>
                    </div>
                </div>
            </div>
            <div class="card mt-3 p-3">
                <p class="header-detail-produk">Detail Produk</p>
                @foreach ($alltransaksi as $banksampahid => $alltransaksibanksampah)
                    @foreach ($allbanksampah as $banksampah)
                        <p class="bankname-detail-transaksi mt-2" {{ $banksampah->id != $banksampahid ? 'hidden' : '' }}>
                            {{ $banksampah->nama_banksampah }}</p>
                    @endforeach
                    @foreach ($alltransaksibanksampah as $transaksi)
                        <div class="detail-produk card mt-2">
                            <div class="row">
                                <div class="col-3">
                                    <img src="{{ asset('storage/foto/' . $transaksi->foto) }}" class="card-img-pembelian">
                                </div>
                                <div class="col-9">
                                    <div class="row align-items-center py-2">
                                        <div class="col-8">
                                            <p class="nama-sampah-detail-transaksi">{{ $transaksi->nama_sampah }}</p>
                                            <p class="harga-sampah-detail-transaksi">{{ $transaksi->jumlah_barang }} x Rp. {{ $transaksi->harga_satuan }}/Kg
                                            </p>
                                            <p class="status-detail-transaksi">{{ $transaksi->status }}</p>
                                        </div>
                                        <div class="col-4 total-harga-container">
                                            <p class="label-total-detail-transaksi">Total Harga</p>
                                            <p class="total-harga-detail-transaksi">Rp. {{ number_format($transaksi->total_harga, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @foreach ($allbanksampah as $banksampah)
                        <div {{ $banksampah->id != $banksampahid ? 'hidden' : '' }}>
                            <div class="d-flex justify-content-center">
                                <a href="https://wa.me/{{$banksampah->no_hp}}" target="_blank"
                                    class="btn btn-sm btn-success mx-3"><i class="fa-brands fa-whatsapp"
                                        style="margin-right: 5px"></i>Chat Penjual</a>

                                <!-- @foreach ($alltransaksibanksampah as $transaksi)
                                    @if ($loop->first)
                                        @if ($transaksi->status != "Dibatalkan")
                                            <a href="" class="btn btn-sm btn-success mx-3"><i class="fa-solid fa-xmark" style="margin-right: 5px"></i>Batalkan Transaksi</a>
                                        @endif
                                    @endif
                                @endforeach -->
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
            <div class="card mt-3">
                <div class="rincian-pembayaran">
                    <div class="d-flex justify-content-between align-items-center mx-5 my-2">
                        <h4 class="total-belanja-detail-transaksi">Total Belanja :</h4>
                        <h4 class="harga-total-belanja-detail-transaksi">Rp. {{ number_format($pembelian->total_harga, 0, ',', '.') }}</h4>
                    </div>
                </div>
            </div>
            <div class="card mt-3 mb-3">
                <div class="map m-3">
                    <p>Rekomendasi Rute Pembelian</p> 
                    <div class="rincian-pembayaran mb-3">
                        @foreach ($orderedplace as $place)
                            <div class="d-flex justify-content-between align-items-left">
                                {{-- <h4 class="total-belanja-detail-transaksi">{{$loop->iteration}}</h4> --}}
                                <h4 class="total-belanja-detail-transaksi">{{$loop->iteration}} {{ $place }}</h4>
                            </div>
                        @endforeach
                    </div>
                    <div class="card">
                        <div id="map"></div>
                        {{-- <iframe class="mb-3"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15836.896465492711!2d112.17734576977537!3d-7.100003399999994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e778c56bba95239%3A0x1b5fbffeb58417f!2sUD.%20Bintang%20Motor!5e0!3m2!1sid!2sid!4v1675145505514!5m2!1sid!2sid"
                            width="100%" height="500px" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe> --}}
                    </div>

                </div>
            </div>
        </div>
        
        <script src="{{ asset('assets/modules/popper.js') }}"></script>
        <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.js') }}"></script>
        <script src="{{ asset('assets/modules/jquery/jquery.js') }}"></script>
</body>




</html>
