<?php

use App\Models\SpesifikasiSshs;
use App\Models\Sshs;
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
        Schema::create(SpesifikasiSshs::TABLE, function (Blueprint $table) {
            $table->id();
            $table->foreignId('ssh_id')->constrained()->references('id')->on(Sshs::TABLE);
            $table->string('nama');
            $table->string('satuan');
            $table->string('harga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(SpesifikasiSshs::TABLE);
    }
};
