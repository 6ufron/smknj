<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_pengumumans_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengumumans', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Judul pengumuman
            $table->text('content'); // Isi lengkap pengumuman (bisa HTML)
            $table->date('published_at')->nullable(); // Tanggal publikasi (bisa dijadwalkan)
            $table->string('link_url')->nullable(); // URL kustom jika ada (misal: /cek-kelulusan atau link eksternal)
            $table->boolean('is_published')->default(true); // Status terbit atau tidak
            $table->timestamps(); // created_at dan updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengumumans');
    }
};