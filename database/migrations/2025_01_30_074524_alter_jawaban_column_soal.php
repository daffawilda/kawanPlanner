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
        Schema::table('soals', function (Blueprint $table) {
            $table->renameColumn('jawaban_ya', 'jawaban_ya_id');
            $table->renameColumn('jawaban_tidak', 'jawaban_tidak_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('soals', function (Blueprint $table) {
            $table->renameColumn('jawaban_ya_id', 'jawaban_ya');
            $table->renameColumn('jawaban_tidak_id', 'jawaban_tidak');
        });
}
};
