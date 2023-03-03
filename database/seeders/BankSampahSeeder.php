<?php

namespace Database\Seeders;

use App\Models\BankSampah;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BankSampahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        BankSampah::create([
            'users_id'=> 2,
            'nama_banksampah' => 'Bank Sampah Penjual',
            'status' => 'Mengajukan',
        ]);
    }
}
