<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\UsesHashids;

class Alumni extends Model
{
    use UsesHashids;

    protected $table = 'alumni';

    protected $fillable = [
        'nama',
        'nisn',
        'jurusan',
        'status',
        'orang_tua',
        'nomor_induk',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'email'
    ];
}
