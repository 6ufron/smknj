<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Traits\UsesHashids;

class Pengumuman extends Model
{
    use HasFactory, UsesHashids;

    protected $table = 'pengumuman';

    protected $fillable = [
        'title',
        'content',
        'published_at',
        'link_url',
        'is_published',
    ];

    protected $casts = [
        'published_at' => 'date',
        'is_published' => 'boolean',
    ];

    // Accessor untuk excerpt otomatis
    public function getExcerptAttribute()
    {
        return Str::limit(strip_tags($this->content), 100, '...');
    }

    // Accessor untuk format tanggal
    public function getFormattedPublishedAtAttribute()
    {
        return $this->published_at ? $this->published_at->format('j F Y') : 'Belum Dipublikasikan';
    }
}
