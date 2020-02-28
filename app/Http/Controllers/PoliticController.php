<?php

namespace App\Http\Controllers;


//use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class PoliticController extends Controller
{
      

    public function index()
    {
        
        
        return view('politic/politic');
    }
   
}
