<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFasilitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fasilitas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama')->comment('Nama Fasilitas')->nullable();
            $table->enum('kategori', ['AKADEMIK', 'NON_AKADEMIK'])->default('AKADEMIK')->nullable();
            $table->text('deskripsi')->comment('Deskripsi Singkat')->nullable();
            $table->string('foto_path')->comment('Tempat Penyimpan Path Foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fasilitas');
    }
}
