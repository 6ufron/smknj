<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\UsesHashids;

class ProfilSekolah extends Model
{
    use UsesHashids;

    protected $table = 'profil_sekolah';
}
