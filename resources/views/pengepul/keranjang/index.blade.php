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
                                <input class="form-check-input" type="checkbox" value="" id="checkall"
                                    onchange="event.preventDefault(); checkallbox(this);">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Pilih Semua
                                </label>
                            </div>
                            <hr>
                            <div id="allcheckbox">
                                @foreach ($banksampah as $b)
                                    @foreach ($cart as $bankSampah_id => $toko)
                                        @if ($b->id == $bankSampah_id)
                                            <div class="row align-items-center">
                                                <div class="col-1 d-flex justify-content-center">
                                                    <div class="form-check">
                                                        <input class="form-check-input cbpertoko" type="checkbox"
                                                            value="{{ $bankSampah_id }}" id="cbpertoko{{ $bankSampah_id }}"
                                                            onchange="event.preventDefault(); changeToko({{ $bankSampah_id }}, this);">
                                                    </div>
                                                </div>
                                                <div class="col-11">
                                                    <div class="toko-name-keranjang">{{ $b->nama_banksampah }}</div>
                                                </div>
                                                <div id="{{ $bankSampah_id }}">
                                                    @foreach ($toko as $item)
                                                        <div class="row align-items-center mb-3">
                                                            <div class="col-1 d-flex justify-content-center">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        value="{{ $item->id }}"
                                                                        onchange="event.preventDefault(); dosomething({{ $bankSampah_id }}, this.value, this);"
                                                                        id="cbperitem{{ $item->id }}">
                                                                    <input name="item{{ $item->id }}[id]"
                                                                        id="item{{ $item->id }}[id]"
                                                                        style="display: none;" value="" hidden>
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
                                                                    <p class="cost-satuan-keranjang"
                                                                        id="item{{ $item->id }}[price]">
                                                                        Rp.
                                                                        {{ number_format($item->harga, 0, ',', '.') }}/kg
                                                                    </p>
                                                                    <input
                                                                        value="Rp. {{ number_format($item->total_harga, 0, ',', '.') }}"
                                                                        name="item{{ $item->id }}[total_harga]"
                                                                        id="item{{ $item->id }}[total_harga]"
                                                                        class="cost-keranjang" readonly />
                                                                </div>
                                                                <div class="d-flex justify-content-end">
                                                                    <div class="d-flex justify-content-end">
                                                                        <div class="btn btn-link px-2"
                                                                            onclick="this.parentNode.querySelector('input[type=number]').stepDown(); totalCost({{ $item->id }}, '-');">
                                                                            <i class="fas fa-minus"></i>
                                                                        </div>

                                                                        <input id="item{{ $item->id }}[jumlah_barang]"
                                                                            min="1"
                                                                            name="item{{ $item->id }}[jumlah_barang]"
                                                                            value="{{ $item->jumlah_barang }}"
                                                                            type="number"
                                                                            class="form-control form-control-barang-keranjang" />

                                                                        <div class="btn btn-link px-2"
                                                                            onclick="this.parentNode.querySelector('input[type=number]').stepUp(); totalCost({{ $item->id }}, '+');">
                                                                            <i class="fas fa-plus"></i>
                                                                        </div>
                                                                    </div>
                                                                    <button class="btn btn-sm btn-danger mx-3"><i
                                                                            class="far fa-trash-alt"
                                                                            style="margin-right: 5px"></i>Hapus</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <hr style="margin-top: 0">
                                        @endif
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-3 m-0 p-0">
                        <div class="card m-3 p-3">
                            <p class="ringkasan-belanja">Ringkasan Belanja</p>
                            <div class="d-flex justify-content-between">
                                <p class="label-total-harga-cart" style="margin: 0; padding: 0;">Total Harga</p>
                                <p id="total_keranjang" class="total-harga-cart">Rp. {{ number_format(0, 0, ',', '.') }}
                                </p>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <p class="label-total-harga-cart-akhir" style="margin: 0; padding: 0;">Total Harga</p>
                                <p id="total_bayar" class="total-harga-cart-akhir">Rp. {{ number_format(0, 0, ',', '.') }}
                                </p>
                            </div>
                            <button id="btnsubmit" type="submit" class="btn btn-success btn-block mt-3">Beli (0)</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        function dosomething(bankSampah_id, id, checkboxElem) {
            var idsampah = "item" + id + "[id]";
            var idtotalharga = "item" + id + "[total_harga]";

            var inputsampah = document.getElementById(idsampah);
            var btnsubmit = document.getElementById("btnsubmit");
            var total_keranjang = document.getElementById("total_keranjang");
            var total_bayar = document.getElementById("total_bayar");
            var price = document.getElementById(idtotalharga);

            var textprice = parseInt(price.value.replace(/[^,\d]/g, ''));
            var textsubmit = parseInt(btnsubmit.innerHTML.replace(/[^,\d]/g, ''));
            var texttotal_keranjang = parseInt(total_keranjang.innerHTML.replace(/[^,\d]/g, ''));
            var texttotal_bayar = parseInt(total_bayar.innerHTML.replace(/[^,\d]/g, ''));

            if (checkboxElem.checked) {
                textsubmit = textsubmit + 1;
                texttotal_keranjang = texttotal_keranjang + textprice;
                texttotal_bayar = texttotal_bayar + textprice;

                inputsampah.value = id;
                btnsubmit.innerHTML = "Beli (" + textsubmit.toString() + ")";
                total_keranjang.innerHTML = currency(texttotal_keranjang.toString(), 'Rp');
                total_bayar.innerHTML = currency(texttotal_bayar.toString(), 'Rp');

                var allChecked = 0;
                var selectedToko = document.getElementById(bankSampah_id);
                var allCBSelectedToko = selectedToko.querySelectorAll('input[type="checkbox"]');
                for (var i = 0; i < allCBSelectedToko.length; i++) {
                    if (!allCBSelectedToko[i].checked) {
                        allChecked = 1;
                    }
                }
                if (allChecked == 0) {
                    var idcbpertoko = "cbpertoko" + bankSampah_id;
                    var selectedToko = document.getElementById(idcbpertoko);
                    selectedToko.checked = true;
                }
            } else {
                textsubmit = textsubmit - 1;
                texttotal_keranjang = texttotal_keranjang - textprice;
                texttotal_bayar = texttotal_bayar - textprice;

                inputsampah.value = "";
                btnsubmit.innerHTML = "Beli (" + textsubmit.toString() + ")";
                total_keranjang.innerHTML = currency(texttotal_keranjang.toString(), 'Rp');
                total_bayar.innerHTML = currency(texttotal_bayar.toString(), 'Rp');


                var allChecked = 1;
                var selectedToko = document.getElementById(bankSampah_id);
                var allCBSelectedToko = selectedToko.querySelectorAll('input[type="checkbox"]');
                for (var i = 0; i < allCBSelectedToko.length; i++) {
                    if (allCBSelectedToko[i].checked) {
                        allChecked = 0;
                    }
                }
                if (allChecked == 1) {
                    var idcbpertoko = "cbpertoko" + bankSampah_id;
                    var selectedToko = document.getElementById(idcbpertoko);
                    selectedToko.checked = false;
                }
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

        function totalCost(id, step) {
            var idtotalharga = "item" + id + "[total_harga]";
            var idtotalitem = "item" + id + "[jumlah_barang]";
            var idprice = "item" + id + "[price]";

            var price = document.getElementById(idprice).innerHTML;
            var totalproduct = document.getElementById(idtotalitem).value;

            price = parseInt(price.replace(/[^,\d]/g, ''));
            var totalprice = 0;
            var totalprice = price * totalproduct;
            totalprice = currency(totalprice.toString(), 'Rp');
            document.getElementById(idtotalharga).value = totalprice;

            var idsampah = "item" + id + "[id]";
            var idcb = "cbperitem" + id;

            var inputsampah = document.getElementById(idsampah);
            var total_keranjang = document.getElementById("total_keranjang");
            var total_bayar = document.getElementById("total_bayar");
            var price = document.getElementById(idprice);
            var checkboxElem = document.getElementById(idcb);

            var textprice = parseInt(price.innerHTML.replace(/[^,\d]/g, ''));
            var texttotal_keranjang = parseInt(total_keranjang.innerHTML.replace(/[^,\d]/g, ''));
            var texttotal_bayar = parseInt(total_bayar.innerHTML.replace(/[^,\d]/g, ''));

            if (checkboxElem.checked) {
                if (step == "+") {
                    texttotal_keranjang = texttotal_keranjang + textprice;
                    texttotal_bayar = texttotal_bayar + textprice;
                } else {
                    if (inputsampah.value < 1) {
                        texttotal_keranjang = texttotal_keranjang - textprice;
                        texttotal_bayar = texttotal_bayar - textprice;
                    }
                }
                total_keranjang.innerHTML = currency(texttotal_keranjang.toString(), 'Rp');
                total_bayar.innerHTML = currency(texttotal_bayar.toString(), 'Rp');
            }
        }

        function changeToko(bankSampah_id, checkboxElem) {
            var selectedToko = document.getElementById(bankSampah_id);
            var allCBSelectedToko = selectedToko.querySelectorAll('input[type="checkbox"]');

            if (checkboxElem.checked) {
                for (var i = 0; i < allCBSelectedToko.length; i++) {
                    if (!allCBSelectedToko[i].checked) {
                        allCBSelectedToko[i].checked = true;
                        dosomething(bankSampah_id, allCBSelectedToko[i].value, allCBSelectedToko[i]);
                    }
                }
            } else {
                for (var i = 0; i < allCBSelectedToko.length; i++) {
                    if (allCBSelectedToko[i].checked) {
                        allCBSelectedToko[i].checked = false;
                        dosomething(bankSampah_id, allCBSelectedToko[i].value, allCBSelectedToko[i]);
                    }
                }
            }
        }

        function checkallbox(checkboxElem) {
            var all = document.getElementById("allcheckbox");
            var allcbselected = all.querySelectorAll('.cbpertoko');

            if (checkboxElem.checked) {
                for (var i = 0; i < allcbselected.length; i++) {
                    if (!allcbselected[i].checked) {
                        allcbselected[i].checked = true;
                        changeToko(allcbselected[i].value, allcbselected[i]);
                    }
                }
            } else {
                for (var i = 0; i < allcbselected.length; i++) {
                    if (allcbselected[i].checked) {
                        allcbselected[i].checked = false;
                        changeToko(allcbselected[i].value, allcbselected[i]);
                    }
                }
            }
        }
    </script>
@endsection
