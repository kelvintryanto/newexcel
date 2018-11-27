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
            $table->string('insentif')->nullable(); //6
            $table->string('uang_makan')->nullable(); //7
            $table->string('transport')->nullable(); //8
            $table->string('asuransi')->nullable(); //9
            $table->string('lembur')->nullable(); //10
            $table->string('pengobatan')->nullable(); //11
            $table->string('lain')->nullable(); //12
            $table->string('pajak_penerimaan')->nullable(); //13
            $table->string('bpjs_non_tax')->nullable(); //14
            $table->string('bpjs_tax')->nullable(); //15
            $table->integer('pot_gaji')->nullable(); //16
            $table->string('natura_penerimaan')->nullable(); //17
            $table->string('bantuan')->nullable(); //18
            $table->string('thr')->nullable(); //19
            $table->integer('sub_total_penerimaan')->nullable(); //20

            $table->string('iuran')->nullable(); //21
            $table->string('bpjs_karyawan_tax')->nullable(); //22
            $table->string('uangmuka')->nullable(); //23
            $table->string('pajak_pemotongan')->nullable(); //24
            $table->string('sanksipajak')->nullable(); //25
            $table->string('tax')->nullable(); //26
            $table->string('nontax')->nullable(); //27
            $table->string('bpjs_karyawan_non_tax')->nullable(); //28
            $table->string('iuran2')->nullable(); //29
            $table->string('natura_pemotongan')->nullable(); //30
            $table->string('pinjaman_kendaraan')->nullable(); //31
            $table->string('pinjaman_rumah')->nullable(); //32
            $table->string('pinjaman_obat')->nullable(); //33
            $table->string('pinjaman_lain2x')->nullable(); //34
            $table->integer('sub_total_pengeluaran')->nullable(); //35

            $table->string('bulan')->nullable(); //36
            $table->string('tahun')->nullable(); //37
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
