<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayrollKontrak extends Model
{
    protected $table = 'payrollkontrak';
	public $fillable = ['nbp','no_id','nama','cd_jenispenghasilan','keterangan_jenispenghasilan','code','channel','jabatan','jmlhari','commision','override', 'monthlyperformance','quarterlyproduction','monthlyrecruit','operationalallowance','allowance1','allowance2','allowance3','tax_allowance','subtotal_penerimaan','uangmuka','pemotongan1','pemotongan2','pemotongan3','pemotongan4','pemotongan5','pemotongan6','pemotongan7','pph2126','sanksipajak','subtotal_potongan','nilaidibayar','bulan','tahun'];
	public static function UpdateContact($no,$nbp,$no_id,$nama,$cd_jenispenghasilan,$keterangan_jenispenghasilan,$code,$channel,$jabatan,$jmlhari,$commision,$override,$monthlyperformance,$quarterlyproduction,$monthlyrecruit,$operationalallowance,$allowance1,$allowance2,$allowance3,$tax_allowance,$subtotal_penerimaan,$uangmuka,$pemotongan1,$pemotongan2,$pemotongan3,$pemotongan4,$pemotongan5,$pemotongan6,$pemotongan7,$pph2126,$sanksipajak,$subtotal_potongan,$nilaidibayar,$bulan,$tahun){
		$data = array(
			'nbp' => $nbp,
			'no_id' => $no_id,
			'nama' => $nama,
			'cd_jenispenghasilan' => $cd_jenispenghasilan,
			'keterangan_jenispenghasilan' => $keterangan_jenispenghasilan,
			'code' => $code,
			'channel' => $channel,
			'jabatan' => $jabatan,
			'jmlhari' => $jmlhari,
			'commision' => $commision,
			'override' => $override, 
			'monthlyperformance' => $monthlyperformance,
			'quarterlyproduction' => $quarterlyproduction,
			'monthlyrecruit' => $monthlyrecruit,
			'operationalallowance' => $operationalallowance,
			'allowance1' => $allowance1,
			'allowance2' => $allowance2,
			'allowance3' => $allowance3,
			'tax_allowance' => $tax_allowance,
			'subtotal_penerimaan' => $subtotal_penerimaan,
			'uangmuka' => $uangmuka,
			'pemotongan1' => $pemotongan1,
			'pemotongan2' => $pemotongan2,
			'pemotongan3' => $pemotongan3,
			'pemotongan4' => $pemotongan4,
			'pemotongan5' => $pemotongan5,
			'pemotongan6' => $pemotongan6,
			'pemotongan7' => $pemotongan7,
			'pph2126' => $pph2126,
			'sanksipajak' => $sanksipajak,
			'subtotal_potongan' => $subtotal_potongan,
			'nilaidibayar' => $nilaidibayar,
			'bulan' => $bulan,
			'tahun' => $tahun
		);
		return self::where('no', '=', $no)
				->update($data);
	}
}