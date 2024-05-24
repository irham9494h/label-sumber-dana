<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelompok extends Model
{
    use HasFactory;

    const TABLE = 'kelompoks';

    protected $table = self::TABLE;

    protected $guarded = [];
}
