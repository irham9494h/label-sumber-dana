<?php

namespace App\Models;

use Egulias\EmailValidator\Warning\TLD;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Urusan extends Model
{
    use HasFactory;

    const TABLE = 'urusans';

    protected $table = self::TABLE;

    protected $guarded = [];

    protected $hidden = ['created_at', 'updated_at'];

    public function bidangUrusan(): HasMany
    {
        return $this->hasMany(Urusan::class);
    }
}
