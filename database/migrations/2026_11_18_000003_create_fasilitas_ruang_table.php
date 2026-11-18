<?php

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
        Schema::create('fasilitas_ruang', function (Blueprint $table) {
            $table->id();
            $table->string('nama_ruang', 100);
            $table->enum('proyektor', ['Ada', 'Tidak Ada'])->default('Tidak Ada');
            $table->enum('pc', ['Ada', 'Tidak Ada'])->default('Tidak Ada');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fasilitas_ruang');
    }
};
