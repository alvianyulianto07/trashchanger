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
                                                    <input name="item{{$item->id}}[id]"
                                                        id="item{{$item->id}}[id]" style="display: none;"
                                                        value="" hidden>
                                                </div>
                                            </div>
                                            <div class="col-3 text-center">
                                                <img src="{{ asset('storage/foto/' . $item->foto) }}"
                                                    class="card-img-keranjang">
                                            </div>
                                            <div class="col-8 p-0">
                                                <div class="m-2">
                                                    <p class="trash-name-keranjang">Nama barang:
                                                        {{ $item->nama_sampah }}
                                                    </p>
                                                    <p class="cost-satuan-keranjang">Harga satuan {{ $item->harga }}/kg
                                                    </p>
                                                    <input value="{{ $item->total_harga }}" name="item{{$item->id}}[total_harga]"
                                                        id="item{{$item->id}}[total_harga]" class="cost-keranjang"
                                                        readonly />
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <div class="d-flex justify-content-end">
                                                        <div class="btn btn-link px-2"
                                                            onclick="this.parentNode.querySelector('input[type=number]').stepDown(); totalCost();">
                                                            <i class="fas fa-minus"></i>
                                                        </div>

                                                        <input id="item{{$item->id}}[jumlah_barang]" min="1" name="item{{$item->id}}[jumlah_barang]"
                                                            value="{{ $item->jumlah_barang }}" type="number"
                                                            class="form-control form-control-barang-keranjang" />

                                                        <div class="btn btn-link px-2"
                                                            onclick="this.parentNode.querySelector('input[type=number]').stepUp(); totalCost();">
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
                                <input type="number" value="1.000" class="total-harga-cart">
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <p class="label-total-harga-cart-akhir" style="margin: 0; padding: 0;">Total Harga</p>
                                <input type="number" value="1.000" class="total-harga-cart-akhir">
                            </div>
                            <button type="submit" class="btn btn-success btn-block mt-3">Beli (11)</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        function dosomething(id, checkboxElem) {
            var idsampah = "item"+ id + "[id]";

            var inputsampah = document.getElementById(idsampah);
            if (checkboxElem.checked) {
                inputsampah.value = id;
            } else {}
        }
    </script>
@endsection
