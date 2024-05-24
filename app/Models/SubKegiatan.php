<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubKegiatan extends Model
{
    use HasFactory;

    const TABLE = 'sub_kegiatans';

    protected $table = self::TABLE;

    protected $guarded = [];
}
