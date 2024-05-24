<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SumberDanas extends Model
{
    use HasFactory;

    const TABLE = 'sumber_danas';

    protected $table = self::TABLE;

    protected $guarded = [];
}
