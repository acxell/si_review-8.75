<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      DB::table('mahasiswas')->insert([
            'id' => 1,
            'id_user' => 1,
            'nim' => '1232441',
            'nama' => 'Damai',
            'jurusan' => 'teknik sipil',
            'prodi' => 'agribisnis',
            'no_hp' => '0821237671231',
            'alamat' => Str::random(30),
            'status' => 'aktif'
        ]);
    }
}
