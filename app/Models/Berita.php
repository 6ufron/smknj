<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\UsesHashids;

class Berita extends Model
{
    use UsesHashids;

    protected $table = 'berita';

    // Kolom yang bisa diisi massal
    protected $fillable = [
        'title', 'content', 'published_at', 'link_url', 'is_published'
    ];
}
