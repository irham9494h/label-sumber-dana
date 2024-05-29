<?php

use App\Models\BidangUrusan;
use App\Models\BidangUrusanUnitSkpd;
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
        Schema::create(BidangUrusanUnitSkpd::TABLE, function (Blueprint $table) {
            $table->id();
            $table->foreignId('bidang_urusan_id')->constrained()->references('id')->on(BidangUrusan::TABLE);
            $table->foreignId('unit_skpd_id')->constrained()->references('id')->on(UnitSkpd::TABLE);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(BidangUrusanUnitSkpd::TABLE);
    }
};
