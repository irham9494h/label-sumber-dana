<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubRincianObjek extends Model
{
    use HasFactory;

    const TABLE = 'sub_rincian_objeks';

    protected $table = self::TABLE;

    protected $guarded = [];
}
