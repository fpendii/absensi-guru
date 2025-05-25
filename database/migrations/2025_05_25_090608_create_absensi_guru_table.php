<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsensiGuruTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('absensi_guru', function (Blueprint $table) {
            $table->id('id'); // Primary Key
            $table->unsignedBigInteger('id_guru'); // Foreign Key
            $table->date('tanggal');
            $table->time('waktu_masuk')->nullable();
            $table->time('waktu_keluar')->nullable();
            $table->enum('status', ['Hadir', 'Izin', 'Sakit', 'Alfa']);
            $table->text('keterangan')->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('id_guru')->references('id')->on('guru')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi_guru');
    }
}

