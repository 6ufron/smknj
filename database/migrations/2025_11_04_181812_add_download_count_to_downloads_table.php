<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDownloadCountToDownloadsTable extends Migration
{
    public function up()
    {
        Schema::table('downloads', function (Blueprint $table) {
            $table->integer('download_count')->default(0)->after('file_path');
        });
    }

    public function down()
    {
        Schema::table('downloads', function (Blueprint $table) {
            $table->dropColumn('download_count');
        });
    }
}