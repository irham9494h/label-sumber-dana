<?php

use App\Models\Belanja;
use App\Models\BidangUrusan;
use App\Models\SubKegiatan;
use App\Models\TahapanApbd;
use App\Models\UnitSkpd;
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
        Schema::create(Belanja::TABLE, function (Blueprint $table) {
            $table->id();
            $table->foreignId('tahapan_apbd_id')->constrained()->references('id')->on(TahapanApbd::TABLE);
            $table->foreignId('unit_skpd_id')->constrained()->references('id')->on(UnitSkpd::TABLE);
            $table->foreignId('bidang_urusan_id')->constrained()->references('id')->on(BidangUrusan::TABLE);
            $table->foreignId('sub_kegiatan_id')->constrained()->references('id')->on(SubKegiatan::TABLE);
            $table->double('pagu_murni')->default(0);
            $table->double('pagu_validasi')->default(0);
            $table->double('total_rincian')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('belanjas');
    }
};
