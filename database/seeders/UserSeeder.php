<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nama' => 'Administrator',
            'email' => 'admin@email.com',
            'password' => bcrypt('12345678'),
            'alamat' => 'Jl. Lamongrejo No.28 kel, Lamongan, Sidokumpul, Kec. Lamongan, Kabupaten Lamongan',
            'lat' => '-7.1178304',
            'lng' => '112.4192283',
            'no_hp' => '089999999999'
        ]);

        User::create([
            'nama' => 'Penjual',
            'email' => 'penjual@email.com',
            'password' => bcrypt('12345678'),
            'role' => '2',
            'alamat' => 'Jl. KH. Ahmad Dahlan No.24, Kauman, Sidoharjo, Kec. Lamongan, Kabupaten Lamongan',
            'lat' => '-7.1211275',
            'lng' => '112.4135421',
            'no_hp' => '081212341234'
        ]);

        User::create([
            'nama' => 'Pembeli',
            'email' => 'pembeli@email.com',
            'password' => bcrypt('12345678'),
            'role' => '1',
            'alamat' => 'Jl. Kombes Pol Moh. Duryat, Jetis, Kec. Lamongan, Kabupaten Lamongan',
            'lat' => '-7.1210695',
            'lng' => '112.4163735',
            'no_hp' => '081212341234'
        ]);
    }
}
