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
        Schema::create('setting', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_sekolah')->nullable();
            $table->string('npsn')->nullable();
            $table->string('nip')->nullable();
            $table->text('alamat_sekolah')->nullable();
            $table->string('nama_kepsek')->nullable();
            $table->string('ttd_kepsek')->nullable();
            $table->string('password_user')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setting');
    }
};
