<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\UsesHashids;

class Vimisi extends Model
{
    use UsesHashids;

    protected $table = 'visi_misi';
}
