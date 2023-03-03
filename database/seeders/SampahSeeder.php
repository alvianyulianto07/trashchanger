<?php

namespace Database\Seeders;

use App\Models\Sampah;
use Illuminate\Database\Seeder;

class SampahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Sampah::create([
            'bankSampah_id' => 1,
            'kategori_id' => 2,
            'nama_sampah' => 'Botol Plastik',
            'jumlah' => '200',
            'harga' => '1000',
            'foto' => 'botol_plastik_1&upd=11.png',
            'status' => 'Tersedia',
        ]);

        Sampah::create([
            'bankSampah_id' => 1,
            'kategori_id' => 1,
            'nama_sampah' => 'Kresek Plastik',
            'jumlah' => '300',
            'harga' => '500',
            'foto' => 'kresek_plastik_1&upd=11.png',
            'status' => 'Tersedia',
        ]);
    }
}
