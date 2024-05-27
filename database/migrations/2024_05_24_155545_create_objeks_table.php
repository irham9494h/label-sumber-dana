<?php

use App\Models\Jenis;
use App\Models\Objek;
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
        Schema::create(Objek::TABLE, function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_id')->constrained()->references('id')->on(Jenis::TABLE);
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
        Schema::dropIfExists(Objek::TABLE);
    }
};
