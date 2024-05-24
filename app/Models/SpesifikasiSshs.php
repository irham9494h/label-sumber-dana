<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpesifikasiSshs extends Model
{
    use HasFactory;

    const TABLE = 'spesifikasi_sshs';

    protected $table = self::TABLE;

    protected $guarded = [];
}
