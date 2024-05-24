<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BidangUrusan extends Model
{
    use HasFactory;

    const TABLE = 'bidang_urusans';

    protected $table = self::TABLE;

    protected $guarded = [];
}
