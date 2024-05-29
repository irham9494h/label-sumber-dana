<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelompokStandarHarga extends Model
{
    use HasFactory;

    const TABLE = 'kelompok_standar_hargas';

    protected $table = self::TABLE;

    protected $guarded = [];
}
