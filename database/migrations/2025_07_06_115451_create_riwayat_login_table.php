<?php

// database/migrations/..._create_riwayat_login_table.php
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
        Schema::create('riwayat_login', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // ID admin yang login
            $table->string('ip_address', 45)->nullable(); // Alamat IP saat login
            $table->text('user_agent')->nullable(); // Informasi browser dan OS
            $table->timestamp('waktu_login')->useCurrent(); // Waktu login
            $table->timestamps(); // created_at dan updated_at (meskipun updated_at mungkin tidak terlalu relevan di sini)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_login');
    }
};
