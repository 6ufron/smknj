<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\UsesHashids; // <-- trait hashid

class Fasilitas extends Model
{
    use UsesHashids;

    protected $table = 'fasilitas';

    protected $fillable = [
        'nama',
        'kategori',
        'deskripsi',
        'foto_path',
    ];
}
