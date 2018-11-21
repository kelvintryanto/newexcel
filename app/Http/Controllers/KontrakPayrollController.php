<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\PayrollKontrak;
use App\CsvData;
use App\Http\Requests\CsvImportRequest;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class KontrakPayrollController extends Controller
{
    public function index(){
        return view('admin/kontrakPayroll');
    }

    public function getImport()
    {
        return view('importPayrollKontrak');
    }
    public function parseImport(CsvImportRequest $request)
    {
        $path = $request->file('csv_file')->getRealPath();
        if ($request->has('header')) {
            $data = Excel::load($path, function($reader) {})->get()->toArray();
        } else {
            $data = array_map('str_getcsv', file($path));
        }
        if (count($data) > 0) {
            if ($request->has('header')) {
                $csv_header_fields = [];
                foreach ($data[0] as $key => $value) {
                    $csv_header_fields[] = $key;
                }
            }
            $csv_data = array_slice($data, 0, 2);
            $csv_data_file = CsvData::create([
                'csv_filename' => $request->file('csv_file')->getClientOriginalName(),
                'csv_header' => $request->has('header'),
                'csv_data' => json_encode($data)
            ]);
        } else {
            return redirect()->back();
        }
        return view('import_fieldPayrollKontrak', compact( 'csv_header_fields', 'csv_data', 'csv_data_file'));
    }
    
    public function processImport(Request $request)
    {
        $data = CsvData::find($request->csv_data_file_id);
        $csv_data = json_decode($data->csv_data, true);
        foreach ($csv_data as $row) {
            $payrollkontrak = new PayrollKontrak();
            foreach (config('app.db_fieldsPayrollKontrak') as $index => $field) {
                if ($data->csv_header) {//ada header
                    $payrollkontrak->$field = $row[$request->fields[$field]];
                } else {//nga da header
                    $payrollkontrak->$field = $row[$request->fields[$index]];
                }
            }
            //var_dump($payrollkontrak);
            $temp = DB::table('payrollkontrak')
                    ->where('no_id', '=', $payrollkontrak->no_id)->first();
            if(DB::table('payrollkontrak')->where('no_id', '=', $payrollkontrak->no_id)->count() > 0) //CHECK WHETHER ID IS EXIST IN DATABASE
            {//EXIST
                //UPDATE
                $success = PayrollKontrak::UpdateContact($temp->no,$payrollkontrak->nbp,$payrollkontrak->no_id,$payrollkontrak->nama,$payrollkontrak->cd_jenispenghasilan,$payrollkontrak->keterangan_jenispenghasilan,$payrollkontrak->code,$payrollkontrak->channel,$payrollkontrak->jabatan,$payrollkontrak->jmlhari,$payrollkontrak->commision,$payrollkontrak->override,$payrollkontrak->monthlyperformance,$payrollkontrak->quarterlyproduction,$payrollkontrak->monthlyrecruit,$payrollkontrak->operationalallowance,$payrollkontrak->allowance1,$payrollkontrak->allowance2,$payrollkontrak->allowance3,$payrollkontrak->tax_allowance,$payrollkontrak->subtotal_penerimaan,$payrollkontrak->uangmuka,$payrollkontrak->pemotongan1,$payrollkontrak->pemotongan2,$payrollkontrak->pemotongan3,$payrollkontrak->pemotongan4,$payrollkontrak->pemotongan5,$payrollkontrak->pemotongan6,$payrollkontrak->pemotongan7,$payrollkontrak->pph2126,$payrollkontrak->sanksipajak,$payrollkontrak->subtotal_potongan,$payrollkontrak->nilaidibayar,$payrollkontrak->bulan,$payrollkontrak->tahun);
            }
            else
            {//DOES NOT EXIST
                //INSERT
                $payrollkontrak->save();
            }
        }
         echo "<h1>Berhasil Update Database</h1>";
         echo "<br>";
         echo "<a href=kontrakPayroll>Back</a>";
         header( "refresh:3;url=kontrakPayroll" );
         exit;
       // return view('admin/home')->with('alert-success','Berhasil Update Database');
    }
}
