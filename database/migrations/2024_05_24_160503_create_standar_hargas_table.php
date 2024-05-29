<?php

use App\Models\KelompokStandarHarga;
use App\Models\StandarHarga;
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
        Schema::create(StandarHarga::TABLE, function (Blueprint $table) {
            $table->id();
            $table->foreignId('kel_standar_harga_id')->constrained()->references('id')->on(KelompokStandarHarga::TABLE);
            $table->string('kode');
            $table->string('nama');
            $table->string('spek');
            $table->string('satuan')->nullable();
            $table->string('tkdn')->nullable();
            $table->string('tipe')->nullable();
            $table->double('harga')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(StandarHarga::TABLE);
    }
};
