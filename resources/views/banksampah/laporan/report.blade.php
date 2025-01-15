<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 10px; text-align: left; }
    </style>
</head>
<body>

    
    <h2 style="text-align: center;">Laporan Penjualan</h2>

    <h4 style="margin-bottom: 0px; margin-top: 0px;">{{ $bank_name }}</h4>
    <p style="margin-bottom: 0px; margin-top: 0px;">{{ $address }}</p>
    <p style="margin-bottom: px; margin-top: 0px;">{{ $phone }}</p>

    <p>Periode: {{ $period }}</p>

    <table>
        <thead>
            <tr>
                <th>Sampah</th>
                <th>Terjual</th>
                <th>Total Penjualan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $item['nama_sampah'] }}</td>
                    <td>{{ $item['jumlah_barang'] }}</td>
                    <td>{{ number_format($item['total_harga'], 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3 style="text-align: right;">Total Omset: {{ number_format($grand_total, 0, ',', '.') }}</h3>
</body>
</html>