<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class PdfController extends Controller
{
    public function generateInvoice()
    {
        // Define data for the invoice
        $data = [
            'bank_name' => 'NAMA BANK SAMPAH',
            'address' => 'Alamat',
            'phone' => 'Nomor Hp',
            'date' => date('Y-m-d'),
            'invoice_number' => 'INV12345',
            'items' => [
                ['name' => 'Kertas', 'price' => 1000, 'stock' => 2, 'total' => 2000],
                ['name' => 'Botol bekas', 'price' => 1000, 'stock' => 10, 'total' => 10000],
            ],
            'grand_total' => 12000,
        ];

        // Load the view and pass data
        $pdf = PDF::loadView('invoice', $data);

        // Return the generated PDF as a download
        return $pdf->download('invoice.pdf');
    }
}
