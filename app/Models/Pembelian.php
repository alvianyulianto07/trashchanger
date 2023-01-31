<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;
    protected $fillable = [
        'users_id',
        'tanggal',
    ];
    protected $table = 'pembelian';

    public function users(){
    	return $this->belongsTo(User::class);
    }
}
