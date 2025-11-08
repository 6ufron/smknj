<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\UsesHashids; // Trait hashid reusable

class Gafoto extends Model
{
    use UsesHashids;

    protected $table = 'galeri_foto';
}
