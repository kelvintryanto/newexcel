<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Payroll;
use App\CsvData;
use App\Http\Requests\CsvImportRequest;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PayrollController extends Controller
{

    public function getImport()
    {
        return view('importPayroll');
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
        return view('import_fieldPayroll', compact( 'csv_header_fields', 'csv_data', 'csv_data_file'));
    }
    public function processImport(Request $request)
    {
        $data = CsvData::find($request->csv_data_file_id);
        $csv_data = json_decode($data->csv_data, true);
        foreach ($csv_data as $row) {
            $payroll = new Payroll();
            foreach (config('app.db_payrolls') as $index => $field) {
                if ($data->csv_header) {//ada header
                    $payroll->$field = $row[$request->fields[$field]];
                } else {//nga da header
                    $payroll->$field = $row[$request->fields[$index]];
                }
            }
            //var_dump($payroll);
            $temp = DB::table('payroll')
                    ->where('nik', '=', $payroll->nik)->first();
            if(DB::table('payroll')->where('nik', '=', $payroll->nik)->count() > 0) //CHECK WHETHER ID IS EXIST IN DATABASE
            {//EXIST
                //UPDATE
                $success = Payroll::UpdateContact($temp->no,$payroll->nik,$payroll->nama,$payroll->divisi,$payroll->keterangan_divisi,$payroll->kehadiran,$payroll->gaji_pokok,$payroll->insentif,$payroll->uang_makan,$payroll->transport,$payroll->asuransi,$payroll->lembur,$payroll->pengobatan,$payroll->lain,$payroll->pajak,$payroll->bpjs_non_tax,$payroll->bpjs_tax,$payroll->pot_gaji,$payroll->natura,$payroll->bantuan,$payroll->thr,$payroll->sub_total,$payroll->bulan,$payroll->tahun);
            }
            else
            {//DOES NOT EXIST
                //INSERT
                $payroll->save();
            }
        }

         echo "<h1>Berhasil Update Database</h1>";
         echo "<br>";
         echo "<a href=payroll>Back</a>";
         header( "refresh:3;url=payroll" );
         exit;
       // return view('admin/home')->with('alert-success','Berhasil Update Database');

    }
}
