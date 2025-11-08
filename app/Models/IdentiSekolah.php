<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\UsesHashids;

class IdentiSekolah extends Model
{
    use UsesHashids;

    protected $table = 'identitas_sekolah';
}
