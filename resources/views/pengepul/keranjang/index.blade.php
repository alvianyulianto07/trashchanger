@extends('template.master')
@section('konten')
    <div>
        <form action="{{ route('keranjang.checkout') }}" method="POST">
            @csrf
            {{-- PRODUCT GRID --}}
            <div class="container mt-2 card">
                <div class="row">
                    <div class="col-9 m-0 p-0">
                        <div class="mb-3 p-3">
                            <h3 class="header-keranjang">Keranjang</h3>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Pilih Semua
                                </label>
                            </div>
                            <hr>
                            @foreach ($cart as $nama_banksampah => $toko)
                                <div class="row align-items-center">
                                    <div class="col-1 d-flex justify-content-center">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckDefault">
                                        </div>
                                    </div>
                                    <div class="col-11">
                                        <div class="toko-name-keranjang">{{ $nama_banksampah }}</div>
                                    </div>
                                    @foreach ($toko as $item)
                                        <div class="row align-items-center mb-3">
                                            <div class="col-1 d-flex justify-content-center">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        value="{{ $item->id }}"
                                                        onchange="event.preventDefault(); dosomething(this.value, this);"
                                                        id="cbperitem">
                                                    <input name="item{{ $item->id }}[id]"
                                                        id="item{{ $item->id }}[id]" style="display: none;"
                                                        value="" hidden>
                                                </div>
                                            </div>
                                            <div class="col-3 text-center">
                                                <img src="{{ asset('storage/foto/' . $item->foto) }}"
                                                    class="card-img-keranjang">
                                            </div>
                                            <div class="col-8 p-0">
                                                <div class="m-2">
                                                    <p class="trash-name-keranjang">
                                                        {{ $item->nama_sampah }}
                                                    </p>
                                                    <p class="cost-satuan-keranjang" id="price">Rp.
                                                        {{ number_format($item->harga, 0, ',', '.') }}/kg
                                                    </p>
                                                    <input value="Rp. {{ number_format($item->total_harga, 0, ',', '.') }}"
                                                        name="item{{ $item->id }}[total_harga]"
                                                        id="item{{ $item->id }}[total_harga]" class="cost-keranjang"
                                                        readonly />
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <div class="d-flex justify-content-end">
                                                        <div class="btn btn-link px-2"
                                                            onclick="this.parentNode.querySelector('input[type=number]').stepDown(); totalCost({{ $item->id }});">
                                                            <i class="fas fa-minus"></i>
                                                        </div>

                                                        <input id="item{{ $item->id }}[jumlah_barang]" min="1"
                                                            name="item{{ $item->id }}[jumlah_barang]"
                                                            value="{{ $item->jumlah_barang }}" type="number"
                                                            class="form-control form-control-barang-keranjang" />

                                                        <div class="btn btn-link px-2"
                                                            onclick="this.parentNode.querySelector('input[type=number]').stepUp(); totalCost({{ $item->id }});">
                                                            <i class="fas fa-plus"></i>
                                                        </div>
                                                    </div>
                                                    <button class="btn btn-sm btn-danger mx-3"><i class="far fa-trash-alt"
                                                            style="margin-right: 5px"></i>Hapus</button>
                                                </div>
                                            </div>
                                        </div>
                                        </class=>
                                    @endforeach
                                </div>
                                <hr style="margin-top: 0">
                            @endforeach
                        </div>
                    </div>
                    <div class="col-3 m-0 p-0">
                        <div class="card m-3 p-3">
                            <p class="ringkasan-belanja">Ringkasan Belanja</p>
                            <div class="d-flex justify-content-between">
                                <p class="label-total-harga-cart" style="margin: 0; padding: 0;">Total Harga</p>
                                <input type="number" value="0" class="total-harga-cart">
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <p class="label-total-harga-cart-akhir" style="margin: 0; padding: 0;">Total Harga</p>
                                <input type="number" value="0" class="total-harga-cart-akhir">
                            </div>
                            <button id="btnsubmit" type="submit" class="btn btn-success btn-block mt-3">Beli (0)</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        function dosomething(id, checkboxElem) {
            var idsampah = "item" + id + "[id]";

            var inputsampah = document.getElementById(idsampah);
            var btnsubmit = document.getElementById("btnsubmit");
            var textsubmit = parseInt(btnsubmit.innerHTML.replace(/[^,\d]/g, ''));
            if (checkboxElem.checked) {
                textsubmit = textsubmit + 1;
                inputsampah.value = id;
                btnsubmit.innerHTML = "Beli (" + textsubmit.toString() + ")";
            } else {
                inputsampah.value = "";
                textsubmit = textsubmit - 1;
                btnsubmit.innerHTML = "Beli (" + textsubmit.toString() + ")";
            }
        }

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

        function totalCost(id) {
            var idtotalharga = "item" + id + "[total_harga]";
            var idtotalitem = "item" + id + "[jumlah_barang]";
            var price = document.getElementById("price").innerHTML;
            price = parseInt(price.replace(/[^,\d]/g, ''));
            var totalproduct = document.getElementById(idtotalitem).value;
            var totalprice = 0;
            var totalprice = price * totalproduct;
            totalprice = currency(totalprice.toString(), 'Rp');
            document.getElementById(idtotalharga).value = totalprice;
        }
    </script>
@endsection
