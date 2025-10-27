<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengumumanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Pengumuman', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Judul pengumuman
            $table->text('content'); // Isi lengkap pengumuman (bisa HTML)
            $table->date('published_at')->nullable(); // Tanggal publikasi (bisa dijadwalkan)
            $table->string('link_url')->nullable(); // URL kustom jika ada (misal: /cek-kelulusan atau link eksternal)
            $table->boolean('is_published')->default(true); // Status terbit atau tidak
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down(): void
    {
        Schema::dropIfExists('Pengumuman');
    }
}
