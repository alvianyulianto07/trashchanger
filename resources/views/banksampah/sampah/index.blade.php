@extends('banksampah.template.master')
@section('konten')
    <div class="card">
        <div class="m-4">
            <a href="{{ route('sampah.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus mr-2"></i>Tambah
                Sampah</a>
            <br><br>
            <table id="example" class="display col-12">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Kategori</th>
                        <th>Nama Sampah</th>
                        <th>Jumlah</th>
                        <th>Harga/kg</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tr>
                    <td>1</td>
                    <td>Foto Sampah</td>
                    <td>Plastik</td>
                    <td>Kresek Hitam</td>
                    <td>100</td>
                    <td>25.000</td>
                    <td>
                        <form id="" class="p-0" action="" method="POST">
                            @method('DELETE')
                            @csrf
                            <a href="" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                            <a href="" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                            <a href="" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                        </form>
                    </td>
                </tr>
            </table>
        </div>
    @endsection
