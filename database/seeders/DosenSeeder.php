<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('dosens')->insert(
            [
                'id' => 1,
                'id_user' => 1,
                'nidn' => Str::random(10),
                'nip' => Str::random(10),
                'nama' => 'Anton',
                'jurusan' => 'teknik sipil',
                'prodi' => 'agribisnis',
                'alamat' => Str::random(30),
            ],
        );
    }
}
