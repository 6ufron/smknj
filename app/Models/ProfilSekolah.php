<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// 1. Impor library inti Hashids
use Hashids\Hashids;

class ProfilSekolah extends Model
{
    protected $table = 'profil_sekolah';

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
     * Meng-encode ID (misal: 16) menjadi hash (misal: 'eLk9d0Yq2n')
     */
    public function getRouteKey()
    {
        return $this->getHashids()->encode($this->getKey());
    }

    /**
     * 4. Override resolveRouteBinding()
     * Menerjemahkan hash (misal: 'eLk9d0Yq2n') kembali menjadi ID (misal: 16)
     */
    public function resolveRouteBinding($value, $field = null)
    {
        // Decode hash. Hasilnya adalah array, ambil yang pertama [0]
        $id = $this->getHashids()->decode($value)[0] ?? null;

        // Cari data profil sekolah berdasarkan ID asli
        return $this->where('id', $id)->firstOrFail();
    }
}