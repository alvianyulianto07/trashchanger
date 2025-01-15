<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pembelian</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 10px; text-align: left; }
    </style>
</head>
<body>
    <h3 style="text-align: center;">Laporan Pembelian</h3>
    <p>Periode: {{ $period }}</p>

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
            @foreach($items as $data)
                <tr>
                    <td>{{ $data['tanggal'] }}</td>
                    <td>{{ $data['nama_banksampah'] }}</td>
                    <td>{{ $data['nama_sampah'] }}</td>
                    <td>{{ $data['jumlah_barang'] }}</td>
                    <td>Rp {{ number_format($data['harga'], 0, ',', '.');}}</td>
                    <td>Rp {{ number_format($data['total_harga'], 0, ',', '.');}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- <h3 style="text-align: right;">Total: {{ number_format($grand_total, 0, ',', '.') }}</h3> --}}
</body>
</html>