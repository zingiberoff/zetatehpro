<?php

namespace App\Http\Controllers;

class GuestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }


    public function unconfirmed()
    {
        return view('unconfirmed');
    }
}
