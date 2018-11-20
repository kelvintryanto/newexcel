<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Contact;
use App\CsvData;
use App\Http\Requests\CsvImportRequest;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
class ImportController extends Controller
{
    public function getImport()
    {
        return view('import');
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
        return view('import_fields', compact( 'csv_header_fields', 'csv_data', 'csv_data_file'));
    }
    
    public function processImport(Request $request)
    {
        $data = CsvData::find($request->csv_data_file_id);
        $csv_data = json_decode($data->csv_data, true);
        foreach ($csv_data as $row) {
            $contact = new Contact();
            foreach (config('app.db_fields') as $index => $field) {
                if ($data->csv_header) {//ada header
                    $contact->$field = $row[$request->fields[$field]];
                } else {//nga da header
                    $contact->$field = $row[$request->fields[$index]];
                }
            }
            //var_dump($contact);
            $temp = DB::table('karyawan')
                    ->where('no_id', '=', $contact->no_id)->first();
            if(DB::table('karyawan')->where('no_id', '=', $contact->no_id)->count() > 0) //CHECK WHETHER ID IS EXIST IN DATABASE
            {//EXIST
                //UPDATE
                $success = Contact::UpdateContact($contact->no_id,$contact->nama,$contact->no_npwp,$contact->npwp_sejak,$temp->no_urut,$contact->sejak,$contact->alamat_1,$contact->alamat_2,$contact->no_ktp,$contact->kode_negara,$contact->status_pindah,$contact->no_rekening,$contact->bagian,$contact->jabatan,$contact->status_k_tk_hb,$contact->tanggungan,$contact->jenis_kelamin,$contact->ka,$contact->kode_objek_pajak,$contact->mulai_kerja,$contact->akhir_kerja,$contact->kend,$contact->rumah,$contact->obat,$contact->uang,$contact->lain,$contact->pl_obat,$contact->gaji,$contact->tanggal_in,$contact->jml_bulan_in,$contact->pengh_in,$contact->pph_in,$contact->tanggal_out,$contact->bulan_out,$contact->tanggal_lahir);
            }
            else
            {//DOES NOT EXIST
                //INSERT
                $contact->save();
            }
        }

         echo "<h1>Berhasil Update Database</h1>";
         echo "<br>";
         echo "<a href=home>Back</a>";
         header( "refresh:3;url=home" );
         exit;
       // return view('admin/home')->with('alert-success','Berhasil Update Database');

    }
}