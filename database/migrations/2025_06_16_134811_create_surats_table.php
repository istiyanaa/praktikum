<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::create('surats', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_surat', 10);
            $table->string('no_surat', 5);
            $table->date('tanggal');
            $table->string('tujuan', 50);
            $table->string('keterangan', 100)->nullable();
            $table->string('file', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Kembalikan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('surats');
    }
};
