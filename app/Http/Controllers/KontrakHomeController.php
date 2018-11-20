<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\KaryawanKontrak;
use App\CsvData;
use App\Http\Requests\CsvImportRequest;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class KontrakHomeController extends Controller
{

    public function index(){
        return view('admin/kontrakHome');
    }

    public function getImport()
    {
        return view('importKaryawanKontrak');
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
        return view('import_fieldKaryawanKontrak', compact( 'csv_header_fields', 'csv_data', 'csv_data_file'));
    }
    
    public function processImport(Request $request)
    {
        $data = CsvData::find($request->csv_data_file_id);
        $csv_data = json_decode($data->csv_data, true);
        foreach ($csv_data as $row) {
            $karyawankontrak = new KaryawanKontrak();
            foreach (config('app.db_fieldsKontrak') as $index => $field) {
                if ($data->csv_header) {//ada header
                    $karyawankontrak->$field = $row[$request->fields[$field]];
                } else {//nga da header
                    $karyawankontrak->$field = $row[$request->fields[$index]];
                }
            }
            //var_dump($karyawankontrak);
            $temp = DB::table('karyawankontrak')
                    ->where('no_id', '=', $karyawankontrak->no_id)->first();
            if(DB::table('karyawankontrak')->where('no_id', '=', $karyawankontrak->no_id)->count() > 0) //CHECK WHETHER ID IS EXIST IN DATABASE
            {//EXIST
                //UPDATE
                $success = KaryawanKontrak::UpdateContact($temp->no,$karyawankontrak->no_id,$karyawankontrak->nama,$karyawankontrak->no_npwp,$karyawankontrak->npwp_sejak,$karyawankontrak->cd_jenishasil,$karyawankontrak->nama_jenishasil,$karyawankontrak->kerja_di_1_tempat,$karyawankontrak->alamat_1,$karyawankontrak->alamat_2,$karyawankontrak->no_ktp,$karyawankontrak->kode_negara,$karyawankontrak->status,$karyawankontrak->tanggungan,$karyawankontrak->kode_status,$karyawankontrak->jenis_kelamin,$karyawankontrak->mulai_kerja,$karyawankontrak->akhir_kerja,$karyawankontrak->ptkp);
            }
            else
            {//DOES NOT EXIST
                //INSERT
                $karyawankontrak->save();
            }
        }
         echo "<h1>Berhasil Update Database</h1>";
         echo "<br>";
         echo "<a href=kontrakHome>Back</a>";
         header( "refresh:3;url=kontrakHome" );
         exit;
       // return view('admin/home')->with('alert-success','Berhasil Update Database');
    }
}
