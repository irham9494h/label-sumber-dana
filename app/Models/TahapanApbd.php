<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahapanApbd extends Model
{
    use HasFactory;

    const TABLE = 'tahapan_apbds';

    protected $table = self::TABLE;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'is_current' => 'boolean',
        ];
    }
}
