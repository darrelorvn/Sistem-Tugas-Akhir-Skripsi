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
        Schema::create('dosen_bimbingan', function (Blueprint $table) {
            $table->string('nidn', 30)->primary();
            $table->string('nama', 255);
            $table->string('foto', 255)->nullable();
            $table->string('jabatan', 100)->nullable();
            $table->string('kepakaran', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('pendidikan', 255)->nullable();
            $table->text('deskripsi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosen_bimbingan');
    }
};
