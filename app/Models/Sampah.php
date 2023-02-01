<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sampah extends Model
{
    use HasFactory;
    protected $fillable = [
        'bankSampah_id',
        'kategori_id',
        'nama_sampah',
        'jumlah',
        'harga',
        'foto',
        'status'
    ];
    protected $table = 'sampah';

    public function bank_sampah(){
    	return $this->belongsTo(BankSampah::class);
    }
    public function kategori(){
    	return $this->belongsTo(Kategori::class);
    }
}
