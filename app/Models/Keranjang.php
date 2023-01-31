<?php

namespace App\Models;

use App\Models\User;
use App\Models\Sampah;
use App\Models\BankSampah;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Keranjang extends Model
{
    use HasFactory;
    protected $fillable = [
        'users_id',
        'bankSampah_id',
        'sampah_id',
        'jumlah_barang',
        'total_harga',
    ];
    protected $table = 'keranjang';

    public function user(){
    	return $this->belongsTo(User::class);
    }
    public function bank_sampah(){
    	return $this->belongsTo(BankSampah::class);
    }
    public function sampah(){
    	return $this->belongsTo(Sampah::class);
    }
}
