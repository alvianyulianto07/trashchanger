<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;
    protected $fillable = [
        'num_invoice',
        'users_id',
        'tanggal',
        'tanggal_batal',
        'total_harga',
    ];
    protected $table = 'pembelian';

    public function users(){
    	return $this->belongsTo(User::class);
    }
}