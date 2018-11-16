<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KontrakPayrollController extends Controller
{
    public function index(){
        return view('admin/kontrakPayroll');
    }
}
