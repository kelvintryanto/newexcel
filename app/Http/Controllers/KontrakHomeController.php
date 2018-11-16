<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Payroll;
use App\CsvData;
use App\Http\Requests\CsvImportRequest;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class KontrakHomeController extends Controller
{
    public function index(){
        return view('admin/kontrakHome');
    }
}
