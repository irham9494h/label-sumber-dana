<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Akun extends Model
{
    use HasFactory;

    const TABLE = 'akuns';

    protected $table = self::TABLE;

    protected $guarded = [];

    protected $hidden = ['created_at', 'updated_at'];

    public function kelompoks(): HasMany
    {
        return $this->hasMany(Kelompok::class);
    }
}
