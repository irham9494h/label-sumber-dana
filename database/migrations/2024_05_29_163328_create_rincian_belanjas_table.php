<?php

use App\Models\AkunRekening;
use App\Models\Belanja;
use App\Models\RincianBelanja;
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
        Schema::create(RincianBelanja::TABLE, function (Blueprint $table) {
            $table->id();
            $table->foreignId('belanja_id')->constrained()->references('id')->on(Belanja::TABLE);
            $table->foreignId('akun_id')->constrained()->references('id')->on(AkunRekening::TABLE);
            $table->foreignId('standar_harga_id')->constrained()->references('id')->on(StandarHarga::TABLE);
            $table->string('kelompok')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('sumber_dana')->nullable();
            $table->string('nama_penerima_bantuan')->nullable();
            $table->string('koefisien_murni')->default('');
            $table->double('harga_satuan_murni')->default(0);
            $table->double('total_harga_murni')->default(0);
            $table->string('koefisien')->default('');
            $table->double('harga_satuan')->default(0);
            $table->double('total_harga')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(RincianBelanja::TABLE);
    }
};
