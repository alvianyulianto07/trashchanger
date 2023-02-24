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
                    <p id="price" class="harga-display" >Rp. {{ number_format($sampah->harga, 0, ',', '.');}}</p>
                    <hr>
                    <a href="{{ route('beranda.show', $banksampah->id)}}">
                    <p style="margin: 0">Nama Bank Sampah: <strong>{{ $banksampah->nama_banksampah }}</strong></p>
                    </a>
                    <p style="margin: 0">Alamat: <strong>{{ $alamatbanksampah }}</strong></p>
                    <hr>
                    <iframe class="mb-3"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15836.896465492711!2d112.17734576977537!3d-7.100003399999994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e778c56bba95239%3A0x1b5fbffeb58417f!2sUD.%20Bintang%20Motor!5e0!3m2!1sid!2sid!4v1675145505514!5m2!1sid!2sid"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
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
                                    <p class="deskripsi-pembelian">Kategori: <strong>{{ $sampah->kategori_id }}</strong></p>
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

                                        <input id="jumlah_barang" min="1" name="jumlah_barang" value="1" type="number"
                                            class="form-control form-control-barang" />

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
                                        value="Rp. {{ number_format($sampah->harga, 0, ',', '.');}}" readonly></p>
                            </div>
                            <button class="btn btn-success btn-sm mb-2" type="submit">Tambah ke Keranjang</button>
                            <button class="btn btn-outline-success btn-sm">Beli langsung</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
