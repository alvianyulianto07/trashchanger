@extends('admin.template.master')
@section('konten')
    <div class="card">
        <div class="m-4">
            <br><br>
            <table id="example" class="display nowrap" style="width: 100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Bank Sampah</th>
                        <th>Alamat</th>
                        <th>No Ponsel</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($allbanksampah as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->nama_banksampah }}</td>
                            <td>{{ $data->alamat }}</td>
                            <td>{{ $data->no_hp }}</td>
                            <td>{{ $data->status }}</td>
                            <td>
                                <form id="{{ $data->id }}" class="p-0" action="{{ route('banksampah.accept', $data->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <a href="{{ route('banksampah.accept', $data->id) }}" class="btn btn-primary btn-sm"><i
                                            class="fa fa-check"></i></a>
                                    {{-- <button class='delete btn btn-danger btn-sm' value="{{ $data->id }}"
                                        type="submit"><i class="far fa-trash-alt"></i></button> --}}
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endsection
