<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JadwalPenganggaran extends Model
{
    use HasFactory;

    const TABLE = 'jadwal_penganggarans';

    protected $table = self::TABLE;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function tahapan(): BelongsTo
    {
        return $this->belongsTo(Tahapan::class);
    }
}
