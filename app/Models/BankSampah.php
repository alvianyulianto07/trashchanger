<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankSampah extends Model
{
    use HasFactory;
    protected $fillable = [
        'users_id',
        'nama_banksampah',
        'status',
    ];
    protected $table = 'bank_sampah';

    public function users(){
    	return $this->belongsTo(User::class);
    }
    public function sampah(){
    	return $this->belongsToMany(Sampah::class);
    }
}
