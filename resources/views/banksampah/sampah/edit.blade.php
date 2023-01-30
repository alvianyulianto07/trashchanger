@extends('banksampah.template.master')
@section('konten')
    <div class="card">
        {{-- @if (count($errors) > 0)
            @foreach ($errors->all() as $error)
                <div id="flasherror" data-flash=" {{ $error }}"></div>
            @endforeach
        @endif

        @if (Session::has('success'))
            <div id="flash" data-flash="{{ session('success') }}"></div>
        @endif --}}
        <form id="form" action="{{ route('sampah.update', $sampah->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="m-4">
                <div class="row pl-0 pr-0">
                    <div class="font-form-header mb-3 col-6">Ubah Data Sampah</div>
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
                                        {{-- @foreach($sampah as $k)
                                            <option value="{{$k->}}">{{$k->nama_kategori}}</option>
                                        @endforeach --}}
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label for="inputNamaSampah" class="col-sm-2 col-form-label font-form">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" value="{!! $sampah->nama_sampah !!}" required="required"
                                    class="form-control" placeholder="Masukkan Nama Sampah"
                                    id="nama_sampah">
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label for="inputJumlah"  class="col-sm-2 col-form-label font-form">Jumlah</label>
                                <div class="col-sm-10 col-form-label">
                                    <input type="number" name="jumlah" value="{!! $sampah->jumlah !!}" required="required" class="form-control form-control-size" placeholder="Masukkan Jumlah Sampah" id="jumlah">
                                </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label for="inputHarga"  class="col-sm-2 col-form-label font-form">Harga</label>
                                <div class="col-sm-10 col-form-label">
                                    <input type="text" name="harga" value="{!! $sampah->harga !!}" required="required" class="form-control form-control-size" placeholder="Masukkan Harga Sampah" id="harga">
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
                            <button class="btn btn-primary btn-block"><i class="fas fa-save mr-2"></i>Simpan</button>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
@endsection
