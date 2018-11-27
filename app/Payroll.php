<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
   protected $table = 'payroll';
	public $fillable = ['nik','nama','divisi','keterangan_divisi','kehadiran','gaji_pokok','insentif','uang_makan','transport','asuransi','lembur','pengobatan','lain','pajak_penerimaan','bpjs_non_tax','bpjs_tax','pot_gaji','natura_penerimaan','bantuan','thr','sub_total_penerimaan','iuran','bpjs_karyawan_tax','uangmuka','pajak_pemotongan','sanksipajak','tax','nontax','bpjs_karyawan_non_tax','iuran2','natura_pemotongan','pinjaman_kendaraan','pinjaman_rumah','pinjaman_obat','pinjaman_lain2x','sub_total_pengeluaran','bulan','tahun'];

	public static function UpdateContact($no,$nik,$nama,$divisi,$keterangan_divisi,$kehadiran,$gaji_pokok,$insentif,$uang_makan,$transport,$asuransi,$lembur,$pengobatan,$lain,$pajak_penerimaan,$bpjs_non_tax,$bpjs_tax,$pot_gaji,$natura_penerimaan,$bantuan,$thr,$sub_total_penerimaan,$iuran,$bpjs_karyawan_tax,$uangmuka,$pajak_pemotongan,$sanksipajak,$tax,$nontax,$bpjs_karyawan_non_tax,$iuran2,$natura_pemotongan,$pinjaman_kendaraan,$pinjaman_rumah,$pinjaman_obat,$pinjaman_lain2x,$sub_total_pengeluaran,$bulan,$tahun){
		$data = array(
			'nik' => $nik, //0
			'nama' => $nama, //1
			'divisi' => $divisi, //2
			'keterangan_divisi' => $keterangan_divisi, //3
			'kehadiran' => $kehadiran, //4
			'gaji_pokok' => $gaji_pokok, //5
			'insentif' => $insentif, //6
			'uang_makan' => $uang_makan, //7
			'transport' => $transport, //8
			'asuransi' => $asuransi, //9
			'lembur' => $lembur, //10
			'pengobatan' => $pengobatan, //11
			'lain' => $lain, //12
			'pajak_penerimaan' => $pajak_penerimaan, //13
			'bpjs_non_tax' => $bpjs_non_tax, //14
			'bpjs_tax' => $bpjs_tax, //15
			'pot_gaji' => $pot_gaji, //16
			'natura' => $natura, //17
			'bantuan' => $bantuan, //18
			'thr' => $thr, //19
			'sub_total_penerimaan' => $sub_total_penerimaan, //20

			'iuran' => $iuran, //21
			'bpjs_karyawan_tax' => $bpjs_karyawan_tax, //22
			'uangmuka' => $uangmuka, //23
			'pajak_pemotongan' => $pajak_pemotongan, //24
			'sanksipajak' => $sanksipajak, //25
			'tax' => $tax, //26
			'nontax' => $nontax, //27
			'bpjs_karyawan_non_tax' => $bpjs_karyawan_non_tax, //28
			'iuran2' => $iuran2, //29
			'natura_pemotongan' => $natura_pemotongan, //30 
			'pinjaman_kendaraan' => $pinjaman_kendaraan, //31
			'pinjaman_rumah' => $pinjaman_rumah, //32
			'pinjaman_obat' => $pinjaman_obat, //33
			'pinjaman_lain2x' => $pinjaman_lain2x, //34
			'sub_total_pengeluaran' => $sub_total_pengeluaran, //35

			'bulan' => $bulan, //36
			'tahun' => $tahun, //37
		);
		return self::where('no', '=', $no)
				->update($data);
	}
}