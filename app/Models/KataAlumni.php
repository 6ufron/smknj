<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\UsesHashids;

class KataAlumni extends Model
{
    use UsesHashids;

    protected $table = 'kata_alumni';
}
