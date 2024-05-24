<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RincianObjek extends Model
{
    use HasFactory;

    const TABLE = 'rincian_objeks';

    protected $table = self::TABLE;

    protected $guarded = [];
}
