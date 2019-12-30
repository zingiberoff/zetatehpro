<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ApiTokenController extends Controller
{
    /**
     * Update the authenticated user's API token.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function update(Request $request)
    {
        foreach (User::all() as $user) {
            $token = Str::random(60);

            $user->forceFill([
                'api_token' => hash('sha256', $token),
            ])->save();
        }


        return ['success' => true];
    }

    public function getToken(Request $request)
    {

        $token = Str::random(60);

        \Auth::user()->forceFill([
            'api_token' => hash('sha256', $token),
        ])->save();


        return ['token' => $token];
    }
}