<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('berita', function (Blueprint $table) {
            // ubah tipe kolom kalimat jadi LONGTEXT
            $table->longText('kalimat')->change();
        });
    }

    public function down(): void
    {
        Schema::table('berita', function (Blueprint $table) {
            // jika rollback, ubah kembali ke string (opsional)
            $table->string('kalimat', 255)->change();
        });
    }
};
