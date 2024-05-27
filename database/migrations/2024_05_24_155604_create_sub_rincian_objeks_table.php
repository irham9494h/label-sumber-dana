<?php

use App\Models\SubRincianObjek;
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
        Schema::create(SubRincianObjek::TABLE, function (Blueprint $table) {
            $table->id();
            $table->foreignId('rincian_objek_id')->constrained();
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
        Schema::dropIfExists(SubRincianObjek::TABLE);
    }
};
