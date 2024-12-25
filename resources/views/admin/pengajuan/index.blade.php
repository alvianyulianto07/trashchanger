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
                    </tr>
                </thead>
                <tbody>
                    @foreach ($allbanksampah as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->nama_banksampah }}</td>
                            <td>{{ $data->alamat }}</td>
                            <td>{{ $data->no_hp }}</td>
                            <td>
                                <form action="{{ route('banksampah.update', $data->id) }}" method="POST">
                                    @csrf
                                    <select name="status" class="form-control" onchange="this.form.submit()">
                                        <option value="Disetujui" @if ($data->status == "Disetujui") selected="selected" @endif>Disetujui</option>
                                        <option value="Mengajukan" @if ($data->status == "Mengajukan") selected="selected" @endif>Mengajukan</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endsection
