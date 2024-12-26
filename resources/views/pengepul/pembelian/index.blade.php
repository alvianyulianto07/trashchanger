@extends('template.master')
@section('konten')
    <div class="container mt-3">
        <h3 class="header-keranjang mt-2">Daftar Transaksi</h3>
        @foreach ($allpembelian as $pembeliancategory => $category)
            <div class="toko-name-pembelian">{{ $pembeliancategory }}</div>
            <div class="card">
                @foreach ($category as $pembelianid => $pembelian)
                    <div>
                        <div class="row align-items-center">
                            @foreach ($pembelian as $nama_banksampah => $transaksi)
                                @if ($loop->first)
                                    <div class="toko-name-pembelian">{{ $nama_banksampah }}</div>
                                    @foreach ($transaksi as $sampah)
                                        @if ($loop->first)
                                            <div class="row align-items-center mb-3">
                                                <div class="col-4 text-center">
                                                    <img src="{{ asset('storage/foto/' . $sampah->foto) }}"
                                                        class="card-img-pembelian">
                                                </div>
                                                <div class="col-8 p-0">
                                                    <p class="status-pembelian">{{ $sampah->status }}</p>
                                                    <p style="margin: 0" id="timer-pembelian-{{ $pembelianid }}"></p>
                                                    <p class="trash-name-keranjang">
                                                        {{-- {{ $pembelian->nama_sampah }} --}}
                                                    </p>
                                                    {{-- <p class="cost-satuan-keranjang">Harga satuan 5000/kg
                                                    </p> --}}
                                                    <input value="Rp. {{ number_format($sampah->total_harga, 0, ',', '.') }}"
                                                        name="item" id="item" class="cost-keranjang" readonly />
                                                    <p style="margin: 0">Total Pesanan: {{ $loop->count }} produk</p>
                                                    <div class="d-flex justify-content-end">
                                                        <a href="{{ route('pembelian.show', $pembelianid) }}"
                                                            class="btn btn-sm btn-success mx-3"><i class="far fa-eye"
                                                                style="margin-right: 5px"></i>Lihat
                                                            Transaksi</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        </div>
                        @if (!$loop->last)
                            <hr>
                        @endif
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>


    <script>
        window.onload = function() {
            run();

            function run() {
                var all_cancelled_date = {!! json_encode($alltanggalbatal) !!};
                Object.entries(all_cancelled_date).forEach(([key, item]) => {

                    var id_pembelian = "";
                    var tanggal_batal = "";
                    var status = "Selesai";

                    var dibatalkan_count = 0;

                    item.forEach(function(trx) {
                        id_pembelian = trx["id"];
                        tanggal_batal = trx["tanggal_batal"];

                        var trx_status = trx["status"];

                        if (trx_status == "Dalam Proses"){
                            status = "Dalam Proses";
                        } else if (trx_status == "Dibatalkan") {
                            dibatalkan_count += 1;
                        }
                        
                    });

                    console.log(id_pembelian);

                    if (dibatalkan_count > 0) {
                        status = "Dibatalkan";
                    }
                    
                    tanggal_batal = tanggal_batal + "Z";
                    var countDownDate = new Date(tanggal_batal).getTime();

                    if (status == "Dalam Proses"){
                    // Update the count down every 1 second
                        var x = setInterval(function() {

                            // Get today's date and time
                            var now = new Date().getTime();

                            // Find the distance between now and the count down date
                            var distance = countDownDate - now;

                            // Time calculations for days, hours, minutes and seconds
                            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                            
                            var content = "Batal otomatis dalam "
                            if (days != 0){
                                content = content + days + " Hari "
                            }
                            if (hours != 0){
                                content = content + hours + " Jam "
                            }
                            if (minutes != 0){
                                content = content + minutes + " Menit "
                            }
                            if (seconds != 0){
                                content = content + seconds + " Detik"
                            }

                            const idtimer = "timer-pembelian-" + id_pembelian;

                            if (distance <= 0) {
                                clearInterval(x);
                                document.getElementById(idtimer).innerHTML = "";
                            } else {
                                document.getElementById(idtimer).innerHTML = content;
                            }
                        }, 1000);
                    }
                });
            };

        }
    </script>
@endsection
