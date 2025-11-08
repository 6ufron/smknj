<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\UsesHashids;

class Jurusan extends Model
{
    use UsesHashids;

    protected $table = 'program_keahlian';
    
    protected $fillable = [
        'nama',
        'singkatan',
        'deskripsi',
        'foto',
    ];
}
