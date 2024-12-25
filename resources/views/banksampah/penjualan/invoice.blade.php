<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
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

    <p>Tanggal: {{ $date }}</p>
    <p>Invoice: {{ $invoice_number }}</p>

    <table>
        <thead>
            <tr>
                <th>Barang</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ number_format($item['price'], 0, ',', '.') }}</td>
                    <td>{{ $item['stock'] }}</td>
                    <td>{{ number_format($item['total'], 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3 style="text-align: right;">Total: {{ number_format($grand_total, 0, ',', '.') }}</h3>
</body>
</html>