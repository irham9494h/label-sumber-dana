<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Skpd extends Model
{
    use HasFactory;

    const TABLE = 'skpds';

    protected $table = self::TABLE;

    protected $guarded = [];

    public function scopeSearch(Builder $query, string $keyword): void
    {
        $query->when($keyword, function ($query) use ($keyword) {
            $query->where('kode', $keyword)
                ->orWhere('nama', 'like', '%' . $keyword . '%');
        });
    }
}
