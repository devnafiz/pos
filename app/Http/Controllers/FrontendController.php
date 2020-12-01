<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
         //dd('ok');
    	return view('auth.login');
    }
}
