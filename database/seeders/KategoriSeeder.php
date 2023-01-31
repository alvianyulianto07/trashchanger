<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Kategori::create([
            'nama_kategori' => "Plastik",
        ]);

        Kategori::create([
            'nama_kategori' => "Botol",
        ]);

        Kategori::create([
            'nama_kategori' => "Kertas",
        ]);

        Kategori::create([
            'nama_kategori' => "Kaca",
        ]);
        Kategori::create([
            'nama_kategori' => "Karet",
        ]);
        Kategori::create([
            'nama_kategori' => "Kardus",
        ]);
    }
}
