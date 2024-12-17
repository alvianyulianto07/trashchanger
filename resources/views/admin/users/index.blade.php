@extends('admin.template.master')
{{-- @section('konten')
    <div class="card">
        <div class="m-4">
            <br><br>
            <table id="example" class="display nowrap" style="width: 100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nama Sampah</th>
                        <th>Jumlah</th>
                        <th>Harga/kg</th>
                        <th>Nama Pembeli</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($allpenjualan as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->foto }}</td>
                            <td>{{ $data->nama_sampah }}</td>
                            <td>{{ $data->jumlah_barang }}</td>
                            <td>Rp. {{ number_format($data->harga, 0, ',', '.');}}</td>
                            <td>{{ $data->nama }}</td>
                            <td>{{ $data->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endsection --}}
