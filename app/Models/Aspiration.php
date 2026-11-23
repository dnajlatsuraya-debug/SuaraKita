<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aspiration extends Model
{
    protected $table = 'aspirations';

    protected $guarded = [];

    protected $casts = [
        'votes' => 'integer',
    ];

    /**
     * Mendapatkan URL publik foto bukti aspirasi
     */
    public function getPhotoUrlAttribute(): ?string
    {
        if (!$this->evidence_photo) {
            return null;
        }

        if (filter_var($this->evidence_photo, FILTER_VALIDATE_URL)) {
            return $this->evidence_photo;
        }

        return asset('storage/' . ltrim($this->evidence_photo, '/'));
    }
}
