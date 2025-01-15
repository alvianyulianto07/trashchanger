@extends('template.master')
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
<div class="container mt-3">
    <h3 class="header-keranjang mt-2">Laporan Transaksi</h3>
    <!-- Filter Form -->
    <form action="{{ route('beranda.laporan') }}" method="POST">
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
            <button class="btn btn-outline-search" type="submit">
                Filter
            </button>
        </div>
    </form>
    
    <!-- Print Report Form -->
    <form action="{{ route('pembelian.cetak') }}" method="POST">
        @csrf
        <!-- Hidden Inputs for Dropdown Values -->
        <input type="hidden" name="year" id="hidden-year" value="{{ $s_year ?? 'all' }}">
        <input type="hidden" name="month" id="hidden-month" value="{{ $s_month ?? 'all' }}">
        
        <div class="d-flex align-items-center mt-3">
            <!-- Print Button -->
            <button class="btn btn-outline-search mt-2" type="submit">
                Cetak Laporan
            </button>
        </div>
    </form>

    <div class="mt-3 mb-3">
        <div style="font-size: 14px; color: #555;">
            Total Transaksi
        </div>
        <div style="font-size: 24px; font-weight: bold; color: #000;">
            Rp {{ number_format($grand_total, 0, ',', '.') }}
        </div>
    </div>
    
    
    <table id="laporan" class="display col-12 mt-3 mb-3"> 
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Bank Sampah</th>
                <th>Sampah</th>
                <th>Jumlah Pembelian</th>
                <th>Harga</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach($alltransaksi as $data)
                <tr>
                    <td>{{ $data->tanggal }}</td>
                    <td>{{ $data->nama_banksampah }}</td>
                    <td>{{ $data->nama_sampah }}</td>
                    <td>{{ $data->jumlah_barang }}</td>
                    <td>Rp {{ number_format($data->harga, 0, ',', '.');}}</td>
                    <td>Rp {{ number_format($data->total_harga, 0, ',', '.');}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<style>
    table#laporan {
        width: 100%;
        border-collapse: collapse;
    }

    table#laporan th, table#laporan td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    table#laporan th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    table#laporan tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    table#laporan tr:hover {
        background-color: #ddd;
    }
</style>

@endsection