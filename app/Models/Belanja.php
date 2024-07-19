<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Belanja extends Model
{
    use HasFactory;

    const TABLE = 'belanjas';

    protected $table = self::TABLE;

    protected $guarded = [];

    protected $hidden = ['created_at', 'updated_at'];

    public function rincianBelanjas(): HasMany
    {
        return $this->hasMany(RincianBelanja::class);
    }

    public function jadwalPenganggaran(): BelongsTo
    {
        return $this->belongsTo(JadwalPenganggaran::class);
    }

    public function unitSkpd(): BelongsTo
    {
        return $this->belongsTo(UnitSkpd::class);
    }

    public function bidangUrusan(): BelongsTo
    {
        return $this->belongsTo(BidangUrusan::class);
    }

    public function subKegiatan(): BelongsTo
    {
        return $this->belongsTo(SubKegiatan::class);
    }
}
