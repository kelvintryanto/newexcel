<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class KaryawanKontrak extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karyawanKontrak', function (Blueprint $table) {
            $table->increments('no');
            $table->string('no_id')->nullable();
            $table->string('nama')->nullable();
            $table->string('no_npwp')->nullable();
            $table->string('npwp_sejak')->nullable();
            $table->string('cd_jenishasil')->nullable();
            $table->string('nama_jenishasil')->nullable();
            $table->string('kerja_di_1_tempat')->nullable();
            $table->string('alamat_1')->nullable();
            $table->string('alamat_2')->nullable();
            $table->string('no_ktp')->nullable();
            $table->string('kode_negara')->nullable();
            $table->string('status')->nullable();
            $table->string('tanggungan')->nullable();
            $table->string('kode_status')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('mulai_kerja')->nullable();
            $table->string('akhir_kerja')->nullable();
            $table->integer('ptkp')->nullable();
            $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('karyawanKontrak');
    }
}
