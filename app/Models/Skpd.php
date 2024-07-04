<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Staudenmeir\EloquentHasManyDeep\HasManyDeep;

class Skpd extends Model
{
    use HasFactory;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

    const TABLE = 'skpds';

    protected $table = self::TABLE;

    protected $guarded = [];

    protected $hidden = ['created_at', 'updated_at'];

    public function unitSkpds(): HasMany
    {
        return $this->hasMany(UnitSkpd::class);
    }

    public function belanjas(): HasManyThrough
    {
        return $this->hasManyThrough(Belanja::class, UnitSkpd::class);
    }

    public function rincianBelanjas(): HasManyDeep
    {
        return $this->hasManyDeep(RincianBelanja::class, [UnitSkpd::class, Belanja::class]);
    }

    public function scopeSearch(Builder $query, string $keyword): void
    {
        $query->when($keyword, function ($query) use ($keyword) {
            $query->where('kode', $keyword)
                ->orWhere('nama', 'like', '%' . $keyword . '%');
        });
    }
}
