<?php

use App\Models\JadwalPenganggaran;
use App\Models\Tahapan;
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
        Schema::create(JadwalPenganggaran::TABLE, function (Blueprint $table) {
            $table->id();
            $table->foreignId('tahapan_id')->references('id')->on(Tahapan::TABLE);
            $table->year('tahun');
            $table->string('nama_sub_tahapan');

            $table->string('no_perda')->nullable();
            $table->date('tgl_perda');

            $table->string('no_perkada')->nullable();
            $table->date('tgl_perkada');

            $table->date('tgl_rka');
            $table->date('tgl_dpa');

            $table->boolean('is_locked')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(JadwalPenganggaran::TABLE);
    }
};
