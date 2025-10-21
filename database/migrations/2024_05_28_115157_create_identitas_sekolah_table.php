<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIdentitasSekolahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('identitas_sekolah', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama')->nullable();
            $table->string('foto', 255)->nullable();
            $table->string('tahun_berdiri')->nullable();
            $table->string('tahun_beroperasi')->nullable();
            $table->string('nsm')->nullable();
            $table->string('npsn')->nullable();
            $table->string('npwp')->nullable();
            $table->string('status_akreditasi')->nullable();
            $table->string('yayasan_penyelenggara')->nullable();
            $table->string('nomer_telepon')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('alamat')->nullable();
            $table->string('desa')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kota')->nullable();
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
        Schema::dropIfExists('identitas_sekolah');
    }
}
