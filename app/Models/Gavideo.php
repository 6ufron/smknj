<?php

namespace App\Models;

use App\Models\Traits\UsesHashids;
use Illuminate\Database\Eloquent\Model;
// 1. Impor library inti Hashids
use Hashids\Hashids;

class Gavideo extends Model
{
    use UsesHashids;

    protected $table = 'galeri_video';
}