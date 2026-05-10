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
        Schema::create('siswa', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('kelas_id');
            $table->foreign('kelas_id')->references('id')->on('kelas');
            $table->string('jurusan_id');
            $table->foreign('jurusan_id')->references('id')->on('jurusan');
            $table->string('nama_lengkap');
            $table->string('tanggal_lahir');
            $table->string('tempat_lahir');
            $table->bigInteger('nisn');
            $table->bigInteger('nik');
            $table->integer('nis');
            $table->text('alamat');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->enum('agama', ['Islam', 'Kristen', 'Hindu', 'Budha', 'Konghucu']);
            $table->string('foto')->nullable();
            $table->string('nama_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->text('alamat_ortu')->nullable();
            $table->string('nama_wali')->nullable();
            $table->text('alamat_wali')->nullable();
            $table->string('nama_sekolah');
            $table->string('alamat_sekolah');
            $table->integer('tahun_lulus');
            $table->string('nomer_ijazah');
            $table->string('tanggal_keterima');
            $table->string('tahun_ajar');
            $table->string('lulus');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
