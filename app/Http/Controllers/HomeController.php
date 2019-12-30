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
        dump(Auth::user()->hasRole('administrator'));
        return view('home');
    }

    public function test()
    {

        /** @var $project Project */

        $cusomer = Customer::firstOrCreate(['inn' => '123456789'], ['name' => 'Customer Name', 'city' => 'City', 'contact_person' => 'FIO']);

        $project = Auth::user()->projects()->create([
            'name' => 'Name of project',
            'description' => 'Project descipions text',
            'date_release' => '2019-12-12',
            'customer_id' => $cusomer->id,
        ]);


        return;
    }

    public function unconfirmed()
    {

        return view('unconfirmed');
    }
}
