<?php

namespace App\Models;

use App\Models\Sampah;
use App\Models\Pembelian;
use App\Models\BankSampah;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaksi extends Model
{
    use HasFactory;
    protected $fillable = [
        'pembelian_id',
        'bankSampah_id',
        'sampah_id',
        'jumlah_barang',
        'total_harga',
        'status'
    ];
    protected $table = 'transaksi';

    public function pembelian(){
    	return $this->belongsTo(Pembelian::class);
    }
    public function bank_sampah(){
    	return $this->belongsTo(BankSampah::class);
    }
    public function sampah(){
    	return $this->belongsTo(Sampah::class);
    }
}
