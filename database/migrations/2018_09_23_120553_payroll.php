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
            $table->string('nik')->nullable(); //0
            $table->string('nama')->nullable(); //1
            $table->string('divisi')->nullable(); //2
            $table->string('keterangan_divisi')->nullable(); //3
            $table->string('kehadiran')->nullable(); //4
            $table->integer('gaji_pokok')->nullable(); //5
            $table->integer('insentif')->nullable(); //6
            $table->integer('uang_makan')->nullable(); //7
            $table->integer('transport')->nullable(); //8
            $table->integer('asuransi')->nullable(); //9
            $table->integer('lembur')->nullable(); //10
            $table->integer('pengobatan')->nullable(); //11
            $table->integer('lain')->nullable(); //12
            $table->integer('pajak_penerimaan')->nullable(); //13
            $table->integer('bpjs_non_tax')->nullable(); //14
            $table->integer('bpjs_tax')->nullable(); //15
            $table->integer('pot_gaji')->nullable(); //16
            $table->integer('natura_penerimaan')->nullable(); //17
            $table->integer('bantuan')->nullable(); //18
            $table->integer('thr')->nullable(); //19
            $table->integer('sub_total_penerimaan')->nullable(); //20

            $table->integer('iuran')->nullable(); //21
            $table->integer('bpjs_karyawan_tax')->nullable(); //22
            $table->integer('uangmuka')->nullable(); //23
            $table->integer('pajak_pemotongan')->nullable(); //24
            $table->integer('sanksipajak')->nullable(); //25
            $table->integer('tax')->nullable(); //26
            $table->integer('nontax')->nullable(); //27
            $table->integer('bpjs_karyawan_non_tax')->nullable(); //28
            $table->integer('iuran2')->nullable(); //29
            $table->integer('natura_pemotongan')->nullable(); //30
            $table->integer('pinjaman_kendaraan')->nullable(); //31
            $table->integer('pinjaman_rumah')->nullable(); //32
            $table->integer('pinjaman_obat')->nullable(); //33
            $table->integer('pinjaman_uang')->nullable(); //34
            $table->integer('pinjaman_lain2x')->nullable(); //35
            $table->integer('sub_total_pengeluaran')->nullable(); //36
            $table->integer('take_home_pay')->nullable(); //37

            $table->string('bulan')->nullable(); //38
            $table->string('tahun')->nullable(); //39
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
