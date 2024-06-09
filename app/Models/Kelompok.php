<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kelompok extends Model
{
    use HasFactory;

    const TABLE = 'kelompoks';

    protected $table = self::TABLE;

    protected $guarded = [];

    protected $hidden = ['created_at', 'updated_at'];

    public function akun(): BelongsTo
    {
        return $this->belongsTo(Akun::class);
    }

    public function jenis(): HasMany
    {
        return $this->hasMany(Jenis::class);
    }
}
