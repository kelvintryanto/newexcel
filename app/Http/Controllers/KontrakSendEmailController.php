<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\User;

class KontrakSendEmailController extends Controller
{
    public function index()
    {
        return view('admin/kontrakSendEmail');
    }

    public function kontrakSendEmail(Request $request)
{

    //  $email = DB::table('users')->select('email')->where('name','=','kelvin tryanto')->get();
    //  $nama = DB::table('users')->select('name')->where('email','=','kelvin.tryanto@gmail.com')->get();
    // $gaji = DB::table('karyawan')->select('ptkp')->where('nama','=','agus handoyo')->get();


    // $email = $_POST['email'];
    // $nama = $_POST['nama'];
    // $gaji = $_POST['gaji'];
    $gaji = $request->input('gaji');
    $nama = $request->input('nama');
    $email = $request->input('email');
               


    //send  
    Mail::send('emailKontrak', ['nama' => $nama, 'gaji' =>  $gaji], function ($message) use ($request)
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
