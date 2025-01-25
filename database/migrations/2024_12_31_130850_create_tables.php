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
        Schema::create('tables', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::create('poliklinik', function (Blueprint $table) {
            $table->id('id_poliklinik');
            $table->string('nama_poliklinik');
            $table->timestamps();
        });
    
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id('id_pegawai');
            $table->string('nama');
            $table->string('jenis');
            $table->timestamps();
        });
    
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id('no_pendaftaran');
            $table->date('tanggal');
            $table->unsignedBigInteger('id_pasien');
            $table->unsignedBigInteger('id_poliklinik');
            $table->unsignedBigInteger('id_dokter')->nullable();
            $table->unsignedBigInteger('id_pegawai_admisi')->nullable();
            $table->string('pendaftaran_via');
            $table->timestamps();
    
            $table->foreign('id_poliklinik')->references('id_poliklinik')->on('poliklinik');
            $table->foreign('id_dokter')->references('id_pegawai')->on('pegawai');
            $table->foreign('id_pegawai_admisi')->references('id_pegawai')->on('pegawai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tables');
    }
};
