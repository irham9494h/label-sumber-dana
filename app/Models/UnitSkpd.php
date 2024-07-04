<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class UnitSkpd extends Model
{
    use HasFactory;

    const TABLE = 'unit_skpds';

    protected $table = self::TABLE;

    protected $guarded = [];

    protected $hidden = ['created_at', 'updated_at'];

    public function skpd(): BelongsTo
    {
        return $this->belongsTo(Skpd::class);
    }

    public function belanjas(): HasMany
    {
        return $this->hasMany(Belanja::class);
    }

    // public function rincianBelanjas(): HasManyThrough
    // {
    //     return $this->hasManyThrough(RincianBelanja::class, Belanja::class);
    // }
}
