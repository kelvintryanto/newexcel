<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\mail\sendMail;

class mailController extends Controller
{
    
    public function send(){

    	Mail::send(new sendMail());
    }

    public function email(){
    	return view('email');
    }

    public function emailKontrak(){
    	return view('emailKontrak');
    }
}
