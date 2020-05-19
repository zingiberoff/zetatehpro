<?php

namespace App\Http\Controllers;

use App\User;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'confirm', 'permission:confirm-users']);

    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function unconfirm()
    {
        \Auth::user()->hasPermission('confirm-users');
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'unconfirm_user');
        })->get();

        return view('user.unconfirmed', ['users' => $users]);
    }

    public function confirmed()
    {
        \Auth::user()->hasPermission('confirm-users');
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'user');
        })->get();

        return view('user.confirmed', ['users' => $users]);
    }

    public function confirm($id)
    {
        User::find($id)->attachRole('user');
        User::find($id)->detachRole('unconfirm_user');

        return redirect()->route('unconfirmed_users');
    }

}
