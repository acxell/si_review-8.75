<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user')->unique()->nullable();
            $table->string('nim', 20)->unique();
            $table->string('nama');
            $table->enum('jurusan', ['bisnis & informatika', 'teknik sipil', 'teknik mesin', 'pertanian', 'pariwisata']);
            $table->enum('prodi', [
                'teknologi rekayasa perangkat lunak', 'teknologi rekayasa komputer', 'bisnis digital',
                'teknik sipil', 'teknologi rekayasa konstruksi jalan & jembatan', 'teknologi rekayasa manufaktur',
                'teknik manufaktur kapal', 'teknik pengolahan hasil ternak', 'agribisnis',
                'manajemen bisnis pariwisata', 'destinasi pariwisata'
            ]);
            $table->string('no_hp', 15);
            $table->text('alamat');
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        schema::dropIfExists('mahasiswas');
    }
};
