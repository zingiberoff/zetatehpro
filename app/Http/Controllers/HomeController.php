<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Project;
use App\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'confirm']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {     
        return view('home'); 
    }

    public function test()
    {

        /** @var $project Project */
        dump(\Storage::url('products.csv'));

        return;
    }

    public function unconfirmed()
    {

        return view('unconfirmed');
    }
}
