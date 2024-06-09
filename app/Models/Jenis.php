<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Jenis extends Model
{
    use HasFactory;

    const TABLE = 'jenises';

    protected $table = self::TABLE;

    protected $guarded = [];

    protected $hidden = ['created_at', 'updated_at'];

    public function kelompok(): BelongsTo
    {
        return $this->belongsTo(Kelompok::class);
    }
}
