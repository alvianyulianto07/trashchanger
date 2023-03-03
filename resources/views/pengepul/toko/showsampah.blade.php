@extends('template.master')
@section('konten')
    <div>
        <hr>
        <div class="container mt-4">
            <div class="row">
                <div class="col-4">
                    <img class="rounded" src="{{ asset('storage/foto/' . $sampah->foto) }}" width="100%" alt="">
                </div>
                <div class="col-5">
                    <h3 style="margin: 0">{{ $sampah->nama_sampah }}</h3>
                    <p>Stok: <strong>{{ $sampah->jumlah }}</strong></p>
                    <p id="price" class="harga-display">Rp. {{ number_format($sampah->harga, 0, ',', '.') }}</p>
                    <hr>
                    <a href="{{ route('beranda.show', $banksampah->id) }}">
                        <p style="margin: 0">Nama Bank Sampah: <strong>{{ $banksampah->nama_banksampah }}</strong></p>
                    </a>
                    <p style="margin: 0">Alamat: <strong>{{ $alamatbanksampah }}</strong></p>
                    <hr>

                    <div id="address-map-container" style="width:100%;height:100%; ">
                        <div style="width: 100%; height: 100%" id="address-map"></div>
                    </div>
                </div>
                <div class="col-3">
                    <form action="{{ route('beranda.keranjang') }}" method="POST">
                        @csrf
                        <div class="card p-2">
                            <p class="card-buy">Atur jumlah pembelian</p>
                            <div class="row px-2">
                                <div class="col-5">
                                    <img class="rounded" src="{{ asset('storage/foto/' . $sampah->foto) }}" width="100%"
                                        alt="">
                                </div>
                                <div class="col-7">
                                    <p class="deskripsi-pembelian">Nama Item: <strong>{{ $sampah->nama_sampah }}</strong>
                                    </p>
                                    <p class="deskripsi-pembelian">Kategori: <strong>{{ $sampah->kategori_id }}</strong>
                                    </p>
                                </div>
                            </div>
                            <hr>
                            <div class="row px-2 align-items-center">
                                <div class="col-7">
                                    <input name="bankSampah_id" id="bankSampah_id" value="{{ $banksampah->id }}" hidden>
                                </div>
                                <div class="col-7">
                                    <input name="sampah_id" id="sampah_id" value="{{ $sampah->id }}" hidden>
                                </div>
                                <div class="col-7 mb-3">
                                    <div class="d-flex">
                                        <div class="btn btn-link px-2"
                                            onclick="this.parentNode.querySelector('input[type=number]').stepDown(); totalCost();">
                                            <i class="fas fa-minus"></i>
                                        </div>

                                        <input id="jumlah_barang" min="1" name="jumlah_barang" value="1"
                                            type="number" class="form-control form-control-barang" />

                                        <div class="btn btn-link px-2"
                                            onclick="this.parentNode.querySelector('input[type=number]').stepUp(); totalCost();">
                                            <i class="fas fa-plus"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-5 m-0 p-0">
                                    <p style="font-size: 12px">Stok: <strong>{{ $sampah->jumlah }}</strong> Kg</p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between px-2 align-items-center">
                                <p class="label-total-harga">Total harga</p>
                                <p><input class="total-harga" id="totalprice" name="total_harga"
                                        value="Rp. {{ number_format($sampah->harga, 0, ',', '.') }}" readonly></p>
                            </div>
                            <button class="btn btn-success btn-sm mb-2" type="submit">Tambah ke Keranjang</button>
                            <button class="btn btn-outline-success btn-sm">Beli langsung</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initialize">
    </script>
    <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
    <script>
        var koordinat = {!! json_encode($koordinat) !!};

        function initialize() {

            var initLat = parseFloat(koordinat[0]);
            var initLng = parseFloat(koordinat[1]);
            const map = new google.maps.Map(document.getElementById('address-map'), {
                center: {
                    lat: initLat,
                    lng: initLng
                },
                zoom: 17
            });


            var marker = new google.maps.Marker({
                position: {
                    lat: parseFloat(koordinat[0]),
                    lng: parseFloat(koordinat[1])
                },
                map: map
            });
        }
    </script>
    <script>
        function currency(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp ' + rupiah : '');
        }

        function totalCost() {
            var price = document.getElementById("price").innerHTML;
            price = parseInt(price.replace(/[^,\d]/g, ''));
            var totalproduct = document.getElementById("jumlah_barang").value;
            console.log(price);
            var totalprice = 0;
            var totalprice = price * totalproduct;
            totalprice = currency(totalprice.toString(), 'Rp');
            document.getElementById("totalprice").value = totalprice;
        }
    </script>
@endsection
