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
                <tbody>
                    @foreach ($sampah as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->foto }}</td>
                            <td>{{ $data->kategori_id }}</td>
                            <td>{{ $data->nama_sampah }}</td>
                            <td>{{ $data->jumlah }}</td>
                            <td>{{ $data->harga }}</td>
                            <td>
                                <form id="{{$data->id}}" class="p-0" action="{{route('sampah.destroy',$data->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <a href="{{ route('sampah.edit', $data->id) }}" class="btn btn-primary btn-sm"><i
                                            class="fa fa-edit"></i></a>
                                    <a href="{{ route('sampah.show', $data->id) }}" class="btn btn-info btn-sm"><i
                                            class="fa fa-eye"></i></a>
                                    <button class='delete btn btn-danger btn-sm' value="{{$data->id}}" type="submit"><i class="far fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endsection
