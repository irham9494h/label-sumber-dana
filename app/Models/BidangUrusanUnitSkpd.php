<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BidangUrusanUnitSkpd extends Model
{
    use HasFactory;

    const TABLE = 'bidang_urusan_unit_skpds';

    protected $table = self::TABLE;

    protected $guarded = [];
}
