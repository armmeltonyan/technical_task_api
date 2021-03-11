<?php

namespace App\Services;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginService
{
    public static function login($email,$password)
    {
        if(Auth::attempt(['email'=>$email,'password'=>$password]))
        {
            $user = Auth::user();
            $responseArray = [];
            $responseArray['token'] = $user->createToken('MyApp')->accessToken;
            $responseArray['data'] = $user;

            if(is_null($user->email_verified_at))
            {
                return response()->json(['error'=>'Please verify you email'],203);
            }

            return response()->json($responseArray,200);
        }
        
            return response()->json(['error'=>'Unautenticate'],401);
    }
}