<?php

use App\Models\AkunRekening;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(AkunRekening::TABLE, function (Blueprint $table) {
            $table->id();
            $table->string('jenis_akun')->comment('AKUN, KELOMPOK, JENIS, OBJEK, RINCIAN_OBJEK, SUB_RINCIAN_OBJEK');
            $table->string('kode');
            $table->string('nama');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(AkunRekening::TABLE);
    }
};
