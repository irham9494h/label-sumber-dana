<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AkunRekening extends Model
{
    use HasFactory;

    const TABLE = 'akun_rekenings';
    const AKUN = 'AKUN';
    const KELOMPOK = 'KELOMPOK';
    const JENIS = 'JENIS';
    const OBJEK = 'OBJEK';
    const RINCIAN_OBJEK = 'RINCIAN_OBJEK';
    const SUB_RINCIAN_OBJEK = 'SUB_RINCIAN_OBJEK';

    protected $table = self::TABLE;

    protected $guarded = [];

    protected $hidden = ['created_at', 'updated_at'];
}
