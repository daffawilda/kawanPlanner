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
        Schema::create('soals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jurusan_id')->constrained('jurusans')->onDelete('cascade');
            $table->text('pertanyaan');
            // Gunakan unsignedBigInteger untuk relasi ke mata_pelajarans
            $table->unsignedBigInteger('jawaban_ya')->nullable();
            $table->unsignedBigInteger('jawaban_tidak')->nullable();
            $table->timestamps();
        
            // Relasi dengan mata_pelajarans untuk jawaban_ya dan jawaban_tidak
            $table->foreign('jawaban_ya')->references('id')->on('mata_pelajarans')->onDelete('cascade');
            $table->foreign('jawaban_tidak')->references('id')->on('mata_pelajarans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soals');
    }
};
