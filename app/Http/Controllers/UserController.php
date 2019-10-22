<?php

namespace App\Http\Controllers;

use App\User;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'confirm', 'permission:edit-post']);

    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function unconfirm()
    {
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'unconfirm_user');
        })->get();

        dump($users);
        return view('user.unconfirmed', ['users' => $users]);
    }

    public function confirm($id)
    {
        User::find($id)->attachRole('user');
        User::find($id)->detachRole('unconfirm_user');

        return redirect()->route('unconfirmed_users');
    }

}
