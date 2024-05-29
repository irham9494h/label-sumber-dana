<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Belanja extends Model
{
    use HasFactory;

    const TABLE = 'belanjas';

    protected $table = self::TABLE;

    protected $guarded = [];
}
