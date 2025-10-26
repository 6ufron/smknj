<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Pengumuman extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pengumumans'; // <-- TAMBAHKAN BARIS INI

    // Kolom yang boleh diisi massal
    protected $fillable = [
        'title',
        'content',
        'published_at',
        'link_url',
        'is_published',
    ];

    // Konversi kolom ke tipe data yang benar
    protected $casts = [
        'published_at' => 'date',
        'is_published' => 'boolean',
    ];

    // Accessor untuk membuat excerpt otomatis dari content
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