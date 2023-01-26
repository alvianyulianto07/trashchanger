@extends('banksampah.template.master')
@section('konten')
    <div class="card">
        <form id="form" action="{{ route('sampah.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="m-4">
                <div class="row pl-0 pr-0">
                    <div class="font-form-header mb-3 col-6">Masukkan Detail Kendaraan</div>
                    <div class="font-form-header mb-3 col-6 d-flex justify-content-end">
                        <a href="{{ route('sampah.index') }}" class="btn btn-primary btn-sm"><i
                                class="fas fa-arrow-left mr-2"></i>Kembali</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="">
                            <div class="mb-3 row align-items-center">
                                <label for="inputKategori" class="col-sm-2 col-form-label font-form">Kategori</label>
                                <div class="col-sm-10">
                                    <select class="select2 col-sm-12" name="kategori" data-placeholder="Pilih kategori">
                                        <option>Pilih kategori</option>
                                        <option value="1">Plastik</option>
                                        <option value="2">Botol</option>
                                        <option value="3">Besi</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label for="inputNamaSampah" class="col-sm-2 col-form-label font-form">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" value="{{ old('name') }}" required="required"
                                    class="form-control" placeholder="Masukkan Nama Sampah"
                                    id="nama_sampah">
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label for="inputJumlah"  class="col-sm-2 col-form-label font-form">Jumlah</label>
                                <div class="col-sm-10 col-form-label">
                                    <input type="number" name="jumlah" value="{{ old('jumlah') }}" required="required" class="form-control form-control-size" placeholder="Masukkan Jumlah Sampah" id="jumlah">
                                </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label for="inputHarga"  class="col-sm-2 col-form-label font-form">Harga</label>
                                <div class="col-sm-10 col-form-label">
                                    <input type="text" name="harga" value="{{ old('harga') }}" required="required" class="form-control form-control-size" placeholder="Masukkan Harga Sampah" id="harga">
                                </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label for="file-upload" class="col-sm-2 col-form-label font-form">Foto Sampah</label>
                            <div class="form-floating col-sm-10">
                                <input class="form-control file-upload " accept="image/*" name="foto" type="file"
                                    id="file-upload" multiple></input>
                            </div>
                        </div>
                        
                        <div class="row">
                            <button class="btn btn-primary btn-block"><i class="fas fa-save mr-2"></i>Tambah</button>
                        </div>
                    </div>
                </div>

            </div>
        </form>

    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".select2").select2();
        });

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

        var hargabeli = document.getElementById('harga');
        hargabeli.addEventListener('keyup', function(e) {
            hargabeli.value = currency(this.value, 'Rp')
        })

        function navigate(origin, sens) {
            var inputs = $('#form').find(':input:enabled:not(:button)');
            var index = inputs.index(origin);
            index += sens;

            if (index < 0) {
                index = inputs.length - 1;
            }
            if (index > inputs.length - 1) {
                index = 0;
            }

            if (index == 4) {
                $("#pilihmerk").select2('open');
            } else if (index == 6) {
                $("#jenis").select2('open');
            } else {
                inputs.eq(index).focus();
            }
        }

        $('input').keydown(function(e) {
            if (e.keyCode == 38) {
                navigate(e.target, -1);
            }
            if (e.keyCode == 40) {
                navigate(e.target, 1);
            }
        });

        $('textarea').keydown(function(e) {
            if (e.keyCode == 38) {
                navigate(e.target, -1);
            }
            if (e.keyCode == 40) {
                navigate(e.target, 1);
            }
        });

        function selectmetode(id) {
            $(document).ready(function() {
                if (id == 3) {
                    document.getElementById("tipe").focus();
                } else if (id == 5) {
                    document.getElementById("model").focus();
                }
            });
        };
    </script>
@endsection
