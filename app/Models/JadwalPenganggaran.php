<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPenganggaran extends Model
{
    use HasFactory;

    const TABLE = 'jadwal_penganggarans';

    protected $table = self::TABLE;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }
}
