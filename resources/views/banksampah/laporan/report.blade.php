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
    <h2 style="text-align: center;">{{ $bank_name }}</h2>
    <p style="text-align: center;">{{ $address }}</p>
    <p style="text-align: center;">{{ $phone }}</p>
    
    <p>Periode: {{ $period }}</p>

    <table>
        <thead>
            <tr>
                <th>Sampah</th>
                <th>Terjual</th>
                <th>Harga</th>
                <th>Total Penjualan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $item['sampah'] }}</td>
                    <td>{{ $item['jumlah'] }}</td>
                    <td>{{ number_format($item['harga'], 0, ',', '.') }}</td>
                    <td>{{ number_format($item['total'], 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3 style="text-align: right;">Total Omset: {{ number_format($grand_total, 0, ',', '.') }}</h3>
</body>
</html>