<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tambahkan kolom baru ke tabel alumni.
     */
    public function up(): void
    {
        Schema::table('alumni', function (Blueprint $table) {
            // Kolom baru menyesuaikan form pendaftaran
            $table->string('nik', 20)->nullable()->after('id');
            $table->year('tahun_masuk')->nullable()->after('nisn');
            $table->year('tahun_lulus')->nullable()->after('tahun_masuk');
            $table->string('email', 150)->nullable()->after('jurusan');
            $table->string('whatsapp', 20)->nullable()->after('email');
            $table->string('instansi', 255)->nullable()->after('status');
            $table->enum('hadir', ['Ya', 'Tidak'])->nullable()->after('instansi');
            $table->string('foto', 255)->nullable()->after('hadir');
            $table->string('instagram', 100)->nullable()->after('foto');
            $table->string('linkedin', 100)->nullable()->after('instagram');
            $table->text('kesan_pesan')->nullable()->after('linkedin');
        });
    }

    /**
     * Hapus kolom jika rollback.
     */
    public function down(): void
    {
        Schema::table('alumni', function (Blueprint $table) {
            $table->dropColumn([
                'nik',
                'tahun_masuk',
                'tahun_lulus',
                'email',
                'whatsapp',
                'instansi',
                'hadir',
                'foto',
                'instagram',
                'linkedin',
                'kesan_pesan',
            ]);
        });
    }
};
