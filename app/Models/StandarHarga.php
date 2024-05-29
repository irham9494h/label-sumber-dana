<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StandarHarga extends Model
{
    use HasFactory;

    const TABLE = 'standar_hargas';

    protected $table = self::TABLE;

    protected $guarded = [];
}
