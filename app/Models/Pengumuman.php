<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
// 1. Impor library inti Hashids
use Hashids\Hashids;

class Pengumuman extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pengumuman'; 

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

    // --- LOGIKA HASHID UNTUK ROUTE MODEL BINDING ---

    /**
     * 2. Buat fungsi helper privat untuk membuat instance Hashids.
     */
    private function getHashids()
    {
        // Menggunakan app.key adalah praktik yang aman dan konsisten
        // 10 adalah panjang minimal hash yang dihasilkan
        return new Hashids(config('app.key'), 10);
    }

    /**
     * 3. Override getRouteKey()
     * Meng-encode ID (misal: 15) menjadi hash (misal: 'dKj8c9Xp1m')
     */
    public function getRouteKey()
    {
        return $this->getHashids()->encode($this->getKey());
    }

    /**
     * 4. Override resolveRouteBinding()
     * Menerjemahkan hash (misal: 'dKj8c9Xp1m') kembali menjadi ID (misal: 15)
     */
    public function resolveRouteBinding($value, $field = null)
    {
        // Decode hash. Hasilnya adalah array, ambil yang pertama [0]
        $id = $this->getHashids()->decode($value)[0] ?? null;

        // Cari data pengumuman berdasarkan ID asli
        return $this->where('id', $id)->firstOrFail();
    }

    // --- AKHIR LOGIKA HASHID ---


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