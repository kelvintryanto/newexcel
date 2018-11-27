<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PayrollKontrak extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payrollkontrak', function (Blueprint $table) {
            $table->increments('no');
            $table->string('nbp')->nullable();
            $table->string('no_id')->nullable();
            $table->string('nama')->nullable();
            $table->string('cd_jenispenghasilan')->nullable();
            $table->string('keterangan_jenispenghasilan')->nullable();
            $table->string('code')->nullable();
            $table->string('channel')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('jmlhari')->nullable();
            $table->string('commision')->nullable();
            $table->string('override')->nullable();
            $table->string('monthlyperformance')->nullable();
            $table->string('quarterlyproduction')->nullable();
            $table->string('monthlyrecruit')->nullable();
            $table->string('operationalallowance')->nullable();
            $table->string('otherallowance')->nullable();
            $table->string('allowance1')->nullable();
            $table->string('allowance2')->nullable();
            $table->string('allowance3')->nullable();
            $table->string('tax_allowance')->nullable();
            $table->integer('subtotal_penerimaan')->nullable();
            $table->string('uangmuka')->nullable();
            $table->string('pemotongan1')->nullable();
            $table->string('pemotongan2')->nullable();
            $table->string('pemotongan3')->nullable();
            $table->string('pemotongan4')->nullable();
            $table->string('pemotongan5')->nullable();
            $table->string('pemotongan6')->nullable();
            $table->string('pemotongan7')->nullable();
            $table->string('pph2126')->nullable();
            $table->string('sanksipajak')->nullable();
            $table->integer('subtotal_potongan')->nullable();
            $table->integer('nilaidibayar')->nullable();
            $table->string('bulan');
            $table->string('tahun');
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
         Schema::dropIfExists('payrollkontrak');
    }
}
