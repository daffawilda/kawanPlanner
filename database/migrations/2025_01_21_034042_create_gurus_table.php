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
        Schema::create('gurus', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('nama'); // Nama guru
            $table->string('nip')->unique(); // NIP guru
            $table->string('email')->unique(); // Email guru
            $table->string('telepon')->nullable(); // Telepon guru
            $table->foreign('jurusan_id')->references('id')->on('jurusan')->onDelete('cascade'); // Relasi ke tabel jurusan
            $table->timestamps(); // Timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gurus');
    }
};
