<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\UsesHashids;

class Download extends Model
{
    use UsesHashids;

    protected $table = 'download';

    protected $fillable = ['title', 'file_path', 'description', 'published_at'];
}
