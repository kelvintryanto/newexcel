<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Illuminate\Support\Facades\DB;
use App\User;

use DOMDocument;

class Email extends Controller
{
    public function showEmail()
    {
        return view('admin/sendEmail');
    }

    public function sendEmail(Request $request)
{

    // request input dari send email karyawan tetap
    $gaji = $request->input('gaji');
    $nama = $request->input('nama');
    $email = $request->input('email');
               
             

    //send  
    Mail::send('email', ['nama' => $nama, 'gaji' =>  $gaji], function ($message) use ($request)
    {
    $message->subject('Gaji');
    $message->from('donotreply@mandiri.com', 'PT.Mandiri Konsultama Perkasa');
        $message->to($request->email);
    });

            
    return back()->with('alert-success','Berhasil Mengirim Email');
    //return response (['status' => false,'errors' => $e->getMessage()]);
    // else{

    //    return back()->with('alert-failed','Gagal Mengirim Email');
    // }
   } 
}

