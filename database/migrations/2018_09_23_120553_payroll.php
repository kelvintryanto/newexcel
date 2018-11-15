<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Payroll extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
     {
        Schema::create('payroll', function (Blueprint $table) {
            $table->increments('no');
            $table->string('nik')->nullable();
            $table->string('nama')->nullable();
            $table->string('divisi')->nullable();
            $table->string('keterangan_divisi')->nullable();
            $table->string('kehadiran')->nullable();
            $table->string('gaji_pokok')->nullable();
            $table->string('insentif')->nullable();
            $table->string('uang_makan')->nullable();
            $table->string('transport')->nullable();
            $table->string('asuransi')->nullable();
            $table->string('lembur')->nullable();
            $table->string('pengobatan')->nullable();
            $table->string('lain')->nullable();
            $table->string('pajak')->nullable();
            $table->string('bpjs_non_tax')->nullable();
            $table->string('bpjs_tax')->nullable();
            $table->string('pot_gaji')->nullable();
            $table->string('natura')->nullable();
            $table->string('bantuan')->nullable();
            $table->string('thr')->nullable();
            $table->string('sub_total')->nullable();
            $table->string('bulan')->nullable();
            $table->string('tahun')->nullable();
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
        Schema::dropIfExists('payroll');
    }
}
