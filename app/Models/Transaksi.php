<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $fillable = [
        'users_id',
        'bankSampah_id',
        'sampah_id',
        'jumlah_barang',
        'total_harga',
        'tanggal',
    ];
    protected $table = 'transaksi';

    public function users(){
    	return $this->belongsTo(User::class);
    }
    public function bank_sampah(){
    	return $this->belongsTo(BankSampah::class);
    }
    public function sampah(){
    	return $this->belongsTo(Sampah::class);
    }
}
