<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('program_ekstra', function (Blueprint $table) {
            $table->foreignId('ekstra_kategori_id')
                ->nullable()
                ->after('id')
                ->constrained('ekstra_kategori')
                ->nullOnDelete();
        });

        DB::statement("
            ALTER TABLE `program_ekstra`
            CHANGE COLUMN `deskripsi` `deskripsi` TEXT
            NULL DEFAULT NULL
        ");
    }

    public function down(): void
    {
        Schema::table('program_ekstra', function (Blueprint $table) {
            $table->dropForeign(['ekstra_kategori_id']);
            $table->dropColumn('ekstra_kategori_id');
        });

        DB::statement("
            ALTER TABLE `program_ekstra`
            CHANGE COLUMN `deskripsi` `deskripsi` VARCHAR(255)
            NULL DEFAULT NULL
        ");
    }
};
