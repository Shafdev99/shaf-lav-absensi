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
        Schema::create('binduk', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('siswa_id')->nullable();
            $table->foreign('siswa_id')->references('id')->on('siswa');
            $table->string('ke_nama_sekolah')->nullable();
            $table->string('ke_tahun')->nullable();
            $table->string('ke_tingkat')->nullable();
            $table->string('dari_nama_sekolah')->nullable();
            $table->string('dari_tahun')->nullable();
            $table->string('dari_tingkat')->nullable();
            $table->string('foto_saat_sekolah')->nullable();
            $table->string('foto_saat_lulus')->nullable();
            $table->timestamps();
        });
    }

    // public function up(): void
    // {
    //     Schema::create('binduk', function (Blueprint $table) {
    //         $table->uuid('id')->primary();
    //         $table->string('siswa_id')->nullable();
    //         $table->foreign('siswa_id')->references('id')->on('siswa');
    //         $table->string('status')->nullable();
    //         $table->string('nama_sekolah')->nullable();
    //         $table->string('tahun')->nullable();
    //         $table->string('tingkat')->nullable();
    //         $table->string('foto_saat_sekolah')->nullable();
    //         $table->string('foto_saat_lulus')->nullable();
    //         $table->timestamps();
    //     });
    // }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('binduk');
    }
};
