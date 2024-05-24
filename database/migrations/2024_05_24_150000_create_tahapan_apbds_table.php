<?php

use App\Models\TahapanApbd;
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
        Schema::create(TahapanApbd::TABLE, function (Blueprint $table) {
            $table->id();
            $table->year('tahun');
            $table->string('nama');
            $table->string('nomor_dpa')->nullable();
            $table->boolean('is_current')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(TahapanApbd::TABLE);
    }
};
