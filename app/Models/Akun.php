<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akun extends Model
{
    use HasFactory;

    const TABLE = 'akuns';

    protected $table = self::TABLE;

    protected $guarded = [];
}
