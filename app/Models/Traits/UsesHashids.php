<?php

namespace App\Models\Traits;

use Hashids\Hashids;

trait UsesHashids
{
    /**
     * Membuat instance Hashids.
     */
    private function getHashids(): Hashids
    {
        return new Hashids(config('app.key'), 10);
    }

    /**
     * Encode ID menjadi hash untuk route.
     */
    public function getRouteKey(): string
    {
        return $this->getHashids()->encode($this->getKey());
    }

    /**
     * Decode hash menjadi ID asli untuk route binding.
     */
    public function resolveRouteBinding($value, $field = null)
    {
        $id = $this->getHashids()->decode($value)[0] ?? null;
        return $this->where('id', $id)->firstOrFail();
    }
}
