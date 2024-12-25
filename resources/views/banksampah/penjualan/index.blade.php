@extends('banksampah.template.master')
@section('konten')
    <div class="card">
        <div class="m-4">
            {{-- <a href="{{ route('penjualan.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus mr-2"></i>Tambah
                Sampah</a> --}}
            <br><br>
            <table id="example" class="display nowrap" style="width: 100%">
                <thead>
                    <tr>
                        {{-- <th>No</th> --}}
                        <th>Tanggal</th>
                        <th>No Invoice</th>
                        <th>Nama Pembeli</th>
                        <th>Total Pembelian</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($allpenjualan as $all => $pembelian)
                        @foreach ($pembelian as $status => $da)
                            @foreach ($da as $data)
                                @if ($loop->first)
                                    <tr>
                                        {{-- <td>{{ $loop->iteration }}</td> --}}
                                        <td>{{ $data->tanggal }}</td>
                                        <td>{{ $data->num_invoice }}</td>
                                        <td>{{ $data->nama }}</td>
                                        <td>Rp. {{ number_format($data->total_harga, 0, ',', '.');}}</td>
                                        <td>{{ $status }}</td>
                                        <td>
                                            <form action="{{ route('penjualan.cetak', $data->id) }}" method="POST">
                                                @csrf
                                                <button class="btn btn-primary btn-sm" value="{{ $data->id }}"
                                                    type="submit" @if($status === "Dibatalkan") disabled @endif><i class="far fa-print"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    @endsection
