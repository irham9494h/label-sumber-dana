<?php

namespace App\Models;

use Egulias\EmailValidator\Warning\TLD;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Urusan extends Model
{
    use HasFactory;

    const TABLE = 'urusans';

    protected $table = self::TABLE;

    protected $guarded = [];
}
