<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
   protected $table = 'payroll';
	public $fillable = ['nik','nama','divisi','keterangan_divisi','kehadiran','gaji_pokok','insentif','uang_makan','transport','asuransi','lembur','pengobatan','lain','pajak','bpjs_non_tax','bpjs_tax','pot_gaji','natura','bantuan','thr','sub_total','bulan','tahun'];

	public static function UpdateContact($no,$nik,$nama,$divisi,$keterangan_divisi,$kehadiran,$gaji_pokok,$insentif,$uang_makan,$transport,$asuransi,$lembur,$pengobatan,$lain,$pajak,$bpjs_non_tax,$bpjs_tax,$pot_gaji,$natura,$bantuan,$thr,$sub_total,$bulan,$tahun){
		$data = array(
			'nik' => $nik,
			'nama' => $nama,
			'divisi' => $divisi,
			'keterangan_divisi' => $keterangan_divisi,
			'kehadiran' => $kehadiran,
			'gaji_pokok' => $gaji_pokok,
			'insentif' => $insentif,
			'uang_makan' => $uang_makan,
			'transport' => $transport,
			'asuransi' => $asuransi,
			'lembur' => $lembur,
			'pengobatan' => $pengobatan,
			'lain' => $lain,
			'pajak' => $pajak,
			'bpjs_non_tax' => $bpjs_non_tax,
			'bpjs_tax' => $bpjs_tax,
			'pot_gaji' => $pot_gaji,
			'natura' => $natura,
			'bantuan' => $bantuan,
			'thr' => $thr,
			'sub_total' => $sub_total,
			'bulan' => $bulan,
			'tahun' => $tahun,
		);
		return self::where('no', '=', $no)
				->update($data);
	}
}
