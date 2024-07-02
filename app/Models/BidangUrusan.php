<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BidangUrusan extends Model
{
    use HasFactory;

    const TABLE = 'bidang_urusans';

    protected $table = self::TABLE;

    protected $guarded = [];

    protected $hidden = ['created_at', 'updated_at'];

    public function scopeSearch(Builder $query, string $keyword, string $urusanId = null): void
    {
        $query->when($keyword, function ($query) use ($keyword) {
            $query->where('kode', $keyword)->orWhere('nama', 'like', '%' . $keyword . '%');
        })->when($urusanId, function ($query) use ($urusanId) {
            $query->where('urusan_id', $urusanId);
        });
    }

    public function urusan(): BelongsTo
    {
        return $this->belongsTo(Urusan::class);
    }
}
