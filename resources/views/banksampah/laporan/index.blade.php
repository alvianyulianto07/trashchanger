@extends('banksampah.template.master')
@section('konten')

<!-- JavaScript to Sync Dropdown and Hidden Inputs -->
<script>
    const yearDropdown = document.getElementById('year');
    const monthDropdown = document.getElementById('month');
    const hiddenYear = document.getElementById('hidden-year');
    const hiddenMonth = document.getElementById('hidden-month');

    // Sync hidden inputs when dropdown values change
    yearDropdown.addEventListener('change', () => {
        hiddenYear.value = yearDropdown.value;
    });

    monthDropdown.addEventListener('change', () => {
        hiddenMonth.value = monthDropdown.value;
    });

    // Initialize hidden inputs on page load
    hiddenYear.value = yearDropdown.value;
    hiddenMonth.value = monthDropdown.value;
</script>

<div class="card">
    <div style="margin-left: 20px;">
        <h4 class="header-keranjang" style="margin-top: 20px;">Laporan Penjualan</h4>
        <!-- Filter Form -->
        <form action="{{ route('penjualan.laporan') }}" method="POST">
            @csrf
            <div class="d-flex align-items-center mt-3">
                <div class="col-4 me-2">
                    <select name="year" id="year" class="form-select">
                        <option value="all">Semua</option>
                        @foreach($years as $year)
                            <option value="{{ $year }}" {{ $year == $s_year ? 'selected' : '' }}>{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
            
                <div class="col-4 me-2">
                    <select name="month" id="month" class="form-select">
                        <option value="all" {{ $year == "all" ? 'selected' : '' }}>Semua</option>
                        @foreach($months as $month)
                            <option value="{{ $month }}" {{ $month == $s_month ? 'selected' : '' }}>{{ $month }}</option>
                        @endforeach
                    </select>
                </div>
            
                <!-- Filter Button -->
                <button class="btn btn-primary btn-sm" type="submit">
                    Filter
                </button>
            </div>
        </form>
        
        <!-- Print Report Form -->
        <form action="{{ route('penjualan.cetaklaporan') }}" method="POST">
            @csrf
            <!-- Hidden Inputs for Dropdown Values -->
            <input type="hidden" name="year" id="hidden-year" value="{{ $s_year ?? 'all' }}">
            <input type="hidden" name="month" id="hidden-month" value="{{ $s_month ?? 'all' }}">
            
            <div class="d-flex align-items-center mt-3">
                <!-- Print Button -->
                <button class="btn btn-primary btn-sm" type="submit">
                    Cetak Laporan
                </button>
            </div>
        </form>


        <div class="mt-3 mb-3">
            <div style="font-size: 14px; color: #555;">
                Total Omset
            </div>
            <div style="font-size: 24px; font-weight: bold; color: #000;">
                Rp {{ number_format($grand_total, 0, ',', '.') }}
            </div>
        </div>

    </div>
    <div class="m-4">
        {{-- <a href="{{ route('penjualan.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus mr-2"></i>Tambah
            Sampah</a> --}}
        <table id="example" class="display nowrap" style="width: 100%">
            <thead>
                <tr>
                    {{-- <th>No</th> --}}
                    <th>Nama Sampah</th>
                    <th>Terjual</th>
                    <th>Omset Penjualan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($alltransaksi as $data)
                    <tr>
                        <td>{{ $data->nama_sampah }}</td>
                        <td>{{ $data->jumlah_barang }}</td>
                        <td>Rp. {{ number_format($data->total_harga, 0, ',', '.');}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
