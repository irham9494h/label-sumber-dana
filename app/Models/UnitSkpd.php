<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitSkpd extends Model
{
    use HasFactory;

    const TABLE = 'unit_skpds';

    protected $table = self::TABLE;

    protected $guarded = [];
}
