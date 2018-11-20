<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Karyawan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karyawan', function (Blueprint $table) {
            $table->string('no_id')->nullable();
            $table->string('nama')->nullable();
            $table->string('no_npwp')->nullable();
            $table->string('npwp_sejak')->nullable();
            $table->increments('no_urut');
            $table->string('sejak')->nullable();
            $table->string('alamat_1')->nullable();
            $table->string('alamat_2')->nullable();
            $table->string('no_ktp')->nullable();
            $table->string('kode_negara')->nullable();
            $table->string('status_pindah')->nullable();
            $table->string('no_rekening')->nullable();
            $table->string('bagian')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('status_k_tk_hb')->nullable();
            $table->string('tanggungan')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('ka')->nullable();
            $table->string('kode_objek_pajak')->nullable();
            $table->string('mulai_kerja')->nullable();
            $table->string('akhir_kerja')->nullable();
            $table->string('kend')->nullable();
            $table->string('rumah')->nullable();
            $table->string('obat')->nullable();
            $table->string('uang')->nullable();
            $table->string('lain')->nullable();
            $table->string('pl_obat')->nullable();
            $table->string('gaji')->nullable();
            $table->string('tanggal_in')->nullable();
            $table->string('jml_bulan_in')->nullable();
            $table->string('pengh_in')->nullable();
            $table->string('pph_in')->nullable();
            $table->string('tanggal_out')->nullable();
            $table->string('bulan_out')->nullable();
            $table->string('tanggal_lahir')->nullable();
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
        Schema::dropIfExists('karyawan');
    }
}
