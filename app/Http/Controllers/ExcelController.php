<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Payroll;
use App\CsvData;
use App\Http\Requests\CsvImportRequest;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function ExportClients(){
    	Excel::create('clients', function($excel){

    		$excel->sheet('clients',function($sheet){
    			$sheet->loadView('ExportClients');
    		});
    	})->export('xlsx');
    }

    public function upload()
    {
    	return view('upload');
    }

    public function ImportClients()
    {
    	$file = Input::file('file');
    	$file_name = $file->getClientOriginalName();
    	$file->move('files',$file_name);
    	$results = Excel::load('files/'.$file_name,function($reader){
    		$reader->all();
    	})->get();

    	return view('clients',['clients' => $results]);
    }
}
