<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\UsesHashids;

class Ekstrakurikuler extends Model
{
    use UsesHashids;

    protected $table = 'program_ekstra';

    /**
     * Relasi: Satu Program Ekstra dimiliki oleh SATU Kategori
     */
    public function kategori()
    {
        // Pastikan 'ekstra_kategori_id' adalah foreign key di tabel 'program_ekstra'
        return $this->belongsTo(EkstraKategori::class, 'ekstra_kategori_id');
    }
}
