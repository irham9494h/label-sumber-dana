<?php

use App\Models\BidangUrusan;
use App\Models\Program;
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
        Schema::create(Program::TABLE, function (Blueprint $table) {
            $table->id();
            $table->foreignId('bidang_urusan_id')->references('id')->on(BidangUrusan::TABLE);
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
        Schema::dropIfExists(Program::TABLE);
    }
};
