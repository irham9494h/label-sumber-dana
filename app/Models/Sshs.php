<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sshs extends Model
{
    use HasFactory;

    const TABLE = 'sshs';

    protected $table = self::TABLE;

    protected $guarded = [];
}
