<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\UsesHashids;

class EkstraKategori extends Model
{
    use HasFactory, UsesHashids;

    /**
     * Nama tabel yang terhubung dengan model ini.
     *
     * @var string
     */
    protected $table = 'ekstra_kategori';
    
    /**
     * Atribut yang boleh diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_bidang',
        'deskripsi',
    ];

    /**
     * Relasi: Satu Kategori (Bidang) memiliki banyak Program Ekstra.
     */
    public function programEkstra()
    {
        return $this->hasMany(Ekstrakurikuler::class, 'ekstra_kategori_id');
    }
}
