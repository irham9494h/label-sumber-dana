<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RincianBelanja extends Model
{
    use HasFactory;

    const TABLE = 'rincian_belanjas';

    protected $table = self::TABLE;

    protected $guarded = [];
}
