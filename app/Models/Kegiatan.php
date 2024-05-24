<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    const TABLE = 'kegiatans';

    protected $table = self::TABLE;

    protected $guarded = [];
}
