<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objek extends Model
{
    use HasFactory;

    const TABLE = 'objeks';

    protected $table = self::TABLE;

    protected $guarded = [];
}
