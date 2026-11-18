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
        Schema::create('topik', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->string('nama', 255);
            $table->text('topik_utama')->nullable();
            $table->text('keywords')->nullable();
            $table->text('deskripsi')->nullable();
            $table->text('studi_kasus')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('topik');
    }
};
