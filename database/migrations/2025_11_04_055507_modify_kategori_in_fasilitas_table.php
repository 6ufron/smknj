<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Jalankan migrasi:
     * - Mengubah enum kategori dari 'AKADEMIK / NON_AKADEMIK'
     *   menjadi 'Utama / Pendukung' secara bertahap agar tidak error.
     */
    public function up(): void
    {
        // 1. Izinkan semua nilai enum (lama & baru)
        DB::statement("
            ALTER TABLE `fasilitas`
            CHANGE COLUMN `kategori` `kategori`
            ENUM('AKADEMIK', 'NON_AKADEMIK', 'Utama', 'Pendukung')
            NULL DEFAULT NULL
        ");

        // 2. Update data lama ke format baru
        DB::statement("UPDATE `fasilitas` SET `kategori` = 'Utama' WHERE `kategori` = 'AKADEMIK'");
        DB::statement("UPDATE `fasilitas` SET `kategori` = 'Pendukung' WHERE `kategori` = 'NON_AKADEMIK'");

        // 3. Restriksi enum hanya ke nilai final
        DB::statement("
            ALTER TABLE `fasilitas`
            CHANGE COLUMN `kategori` `kategori`
            ENUM('Utama', 'Pendukung')
            NULL DEFAULT 'Pendukung'
            COMMENT 'Diubah dari AKADEMIK/NON_AKADEMIK'
        ");
    }

    /**
     * Rollback migrasi:
     * - Mengembalikan enum & data seperti semula.
     */
    public function down(): void
    {
        // 1. Izinkan semua enum (lama & baru)
        DB::statement("
            ALTER TABLE `fasilitas`
            CHANGE COLUMN `kategori` `kategori`
            ENUM('AKADEMIK', 'NON_AKADEMIK', 'Utama', 'Pendukung')
            NULL DEFAULT NULL
        ");

        // 2. Kembalikan data ke format lama
        DB::statement("UPDATE `fasilitas` SET `kategori` = 'AKADEMIK' WHERE `kategori` = 'Utama'");
        DB::statement("UPDATE `fasilitas` SET `kategori` = 'NON_AKADEMIK' WHERE `kategori` = 'Pendukung'");

        // 3. Restriksi enum hanya ke nilai lama
        DB::statement("
            ALTER TABLE `fasilitas`
            CHANGE COLUMN `kategori` `kategori`
            ENUM('AKADEMIK', 'NON_AKADEMIK')
            NULL DEFAULT 'AKADEMIK'
            COMMENT 'Kategori dikembalikan'
        ");
    }
};
