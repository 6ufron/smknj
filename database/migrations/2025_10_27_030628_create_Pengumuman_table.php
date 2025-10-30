<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengumumanTable extends Migration 
{
    public function up(): void
    {
        Schema::create('pengumuman', function (Blueprint $table) { 
            $table->id();
            $table->string('title'); 
            $table->text('content'); 
            $table->date('published_at')->nullable(); 
            $table->string('link_url')->nullable(); 
            $table->boolean('is_published')->default(true); 
            $table->timestamps(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengumuman'); 
    }
};