<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
	protected $table = 'karyawan';
	public $fillable = ['no_id','nama','no_npwp','npwp_sejak','alamat_1','alamat_2','no_ktp','kode_negara','status_pindah','no_rekening','bagian','jabatan','status_k_tk_hb','tanggungan','jenis_kelamin','ka','kode_objek_pajak','mulai_kerja','akhir_kerja','kend','rumah','obat','uang','lain','pl_obat','gaji','tanggal_in','jml_bulan_in','pengh_in','pph_in','tanggal_out','bulan_out','tanggal_lahir'];

	public static function UpdateContact($no,$no_id,$nama,$no_npwp,$npwp_sejak,$alamat_1,$alamat_2,$no_ktp,$kode_negara,$status_pindah,$no_rekening,$bagian,$jabatan,$status_k_tk_hb,$tanggungan,$jenis_kelamin,$ka,$kode_objek_pajak,$mulai_kerja,$akhir_kerja,$kend,$rumah,$obat,$uang,$lain,$pl_obat,$gaji,$tanggal_in,$jml_bulan_in,$pengh_in,$pph_in,$tanggal_out,$bulan_out,$tanggal_lahir){
		$data = array(
			'no_id' => $no_id,
			'nama' => $nama,
			'no_npwp' => $no_npwp,
			'npwp_sejak' => $npwp_sejak,
			'alamat_1' => $alamat_1,
			'alamat_2' => $alamat_2,
			'no_ktp' => $no_ktp,
			'kode_negara' => $kode_negara,
			'status_pindah' => $status_pindah,
			'no_rekening' => $no_rekening,
			'bagian' => $bagian,
			'jabatan' => $jabatan,
			'status_k_tk_hb' => $status_k_tk_hb,
			'tanggungan' => $tanggungan,
			'jenis_kelamin' => $jenis_kelamin,
			'ka' => $ka,
			'kode_objek_pajak' => $kode_objek_pajak,
			'mulai_kerja' => $mulai_kerja,
			'akhir_kerja' => $akhir_kerja,
			'kend' => $kend,
			'rumah' => $rumah,
			'obat' => $obat,
			'uang' => $uang,
			'lain' => $lain,
			'pl_obat' => $pl_obat,
			'gaji' => $gaji,
			'tanggal_in' => $tanggal_in,
			'jml_bulan_in' => $jml_bulan_in,
			'pengh_in' => $pengh_in,
			'pph_in' => $pph_in,
			'tanggal_out' => $tanggal_out,
			'bulan_out' => $bulan_out,
			'tanggal_lahir' => $tanggal_lahir,
		);
		return self::where('no', '=', $no)
				->update($data);
	}
}
