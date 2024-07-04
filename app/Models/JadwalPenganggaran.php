<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class JadwalPenganggaran extends Model
{
    use HasFactory, SoftDeletes;

    const TABLE = 'jadwal_penganggarans';

    protected $table = self::TABLE;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    // SCOPE
    public function scopeSearch(Builder $query, string $keyword): void
    {
        $query->when($keyword, function ($query) use ($keyword) {
            $query->where('nama_sub_tahapan', 'like', '%' . $keyword . '%');
        });
    }

    public function belanjas(): HasMany
    {
        return $this->hasMany(Belanja::class);
    }

    public function tahapan(): BelongsTo
    {
        return $this->belongsTo(Tahapan::class);
    }
}
