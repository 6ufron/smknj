<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('berita', function (Blueprint $table) {
            // Tambahkan kolom 'akses' hanya jika belum ada
            if (!Schema::hasColumn('berita', 'akses')) {
                $table->integer('akses')->default(0)->after('kategori');
            }
        });
    }

    public function down(): void
    {
        Schema::table('berita', function (Blueprint $table) {
            // Hapus kolom 'akses' jika rollback
            if (Schema::hasColumn('berita', 'akses')) {
                $table->dropColumn('akses');
            }
        });
    }
};
