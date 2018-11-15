<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
	protected $table = 'karyawan';
	public $fillable = ['no_id','nama','no_npwp','npwp_sejak','cd_jenishasil','nama_jenishasil','kerja_di_1_tempat','alamat_1','alamat_2','no_ktp', 'kode_negara','status','tanggungan','kode_status','jenis_kelamin','mulai_kerja','akhir_kerja','ptkp'];

	public static function UpdateContact($no, $no_id,$nama,$no_npwp,$npwp_sejak,$cd_jenishasil,$nama_jenishasil,$kerja_di_1_tempat,$alamat_1,$alamat_2,$no_ktp,$kode_negara,$status,$tanggungan,$kode_status,$jenis_kelamin,$mulai_kerja,$akhir_kerja,$ptkp){
		$data = array(
			'no_id' => $no_id,
			'nama' => $nama,
			'no_npwp' => $no_npwp,
			'npwp_sejak' => $npwp_sejak,
			'cd_jenishasil' => $cd_jenishasil,
			'nama_jenishasil' => $nama_jenishasil,
			'kerja_di_1_tempat' => $kerja_di_1_tempat,
			'alamat_1' => $alamat_1,
			'alamat_2' => $alamat_2,
			'no_ktp' => $no_ktp,
			'kode_negara' => $kode_negara,
			'status' => $status,
			'tanggungan' => $tanggungan,
			'kode_status' => $kode_status,
			'jenis_kelamin' => $jenis_kelamin,
			'mulai_kerja' => $mulai_kerja,
			'akhir_kerja' => $akhir_kerja,
			'ptkp' => $ptkp,
		);
		return self::where('no', '=', $no)
				->update($data);
	}
}