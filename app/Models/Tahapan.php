<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tahapan extends Model
{
    use HasFactory;

    const TABLE = 'tahapans';

    protected $table = self::TABLE;

    protected $guarded = [];

    protected $hidden = ['created_at', 'updated_at'];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }
}
