<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\UsesHashids;

class Layanan extends Model
{
    use UsesHashids;

    protected $table = 'layanan';
}
