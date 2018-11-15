<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Illuminate\Support\Facades\DB;
use App\User;

class Email extends Controller
{
    public function sendEmail(Request $request)
    {
        $email = DB::table('users')->select('email')->where('email','=','agus.handoyo@gmail.com')->get();
        $nama = DB::table('users')->select('name')->where('email','=','agus.handoyo@gmail.com')->get();
        $gaji = DB::table('karyawan')->select('ptkp')->where('nama','=','agus handoyo')->get();
        
        
        foreach($email as $email)
        {

                //send
         
            Mail::send('email', ['nama' => $nama, 'gaji' =>  $gaji], function ($message) use ($request)
            {
                $message->subject('Gaji');
                $message->from('donotreply@mandiri.com', 'PT.Mandiri Konsultama Perkasa');
                $message->to('kelvin.tryanto@gmail.com');
            });

        }
        return back()->with('alert-success','Berhasil Mengirim Email');
        
            // else{

            //    return back()->with('alert-failed','Gagal Mengirim Email');
            // }

        
    }
}
