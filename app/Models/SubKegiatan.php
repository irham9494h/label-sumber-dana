<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubKegiatan extends Model
{
    use HasFactory;

    const TABLE = 'sub_kegiatans';

    protected $table = self::TABLE;

    protected $guarded = [];


    protected $hidden = ['created_at', 'updated_at'];

    public function kegiatan(): BelongsTo
    {
        return $this->belongsTo(Kegiatan::class);
    }

    public function scopeSearch(Builder $query, string $keyword): void
    {
        $query->when($keyword, function ($query) use ($keyword) {
            $query->where('kode', $keyword)
                ->orWhere('nama', 'like', '%' . $keyword . '%');
        });
    }
}
