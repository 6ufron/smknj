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
        // Tabel BARU untuk menyimpan Kategori/Bidang Ekstra
        Schema::create('ekstra_kategori', function (Blueprint $table) {
            $table->id(); // Menggunakan bigIncrements 
            $table->string('nama_bidang')->unique(); 
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ekstra_kategori');
    }
};

