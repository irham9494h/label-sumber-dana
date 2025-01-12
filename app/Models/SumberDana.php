<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SumberDana extends Model
{
    use HasFactory;

    const TABLE = 'sumber_danas';

    protected $table = self::TABLE;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'set_input' => 'boolean',
        ];
    }

    public function rincianBelanjas(): HasMany
    {
        return $this->hasMany(RincianBelanja::class);
    }

    // SCOPE
    public function scopeSearch(Builder $query, string $keyword): void
    {
        $query->when($keyword, function ($query) use ($keyword) {
            $query->where('kode', $keyword)
                ->orWhere('nama', 'like', '%' . $keyword . '%');
        });
    }

    public function scopeOnlySetInput(Builder $query): void
    {
        $query->where('set_input', true);
    }
}
