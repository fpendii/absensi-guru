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
        Schema::create('jadwal_mengajar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_guru')->constrained('guru')->onDelete('cascade'); // Foreign key ke tabel 'guru'
            $table->foreignId('id_mapel')->constrained('mata_pelajaran')->onDelete('cascade'); // Foreign key ke tabel 'mata_pelajaran'
            $table->string('hari'); // Contoh: 'Senin', 'Selasa'
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->string('ruangan_kelas'); // Contoh: 'Kelas X-A', 'Lab Komputer'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_mengajar');
    }
};
