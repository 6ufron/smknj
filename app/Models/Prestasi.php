<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\UsesHashids;

class Prestasi extends Model
{
    use HasFactory, UsesHashids;

    protected $table = 'galeri_prestasi';

    protected $fillable = [
        'nama',       // nama prestasi
        'deskripsi',  // deskripsi prestasi
        'foto_path',  // path foto
        'tanggal',    // tanggal prestasi (opsional)
    ];

    // Jika ingin accessor untuk format tanggal
    public function getFormattedTanggalAttribute()
    {
        return $this->tanggal ? $this->tanggal->format('j F Y') : '-';
    }
}
