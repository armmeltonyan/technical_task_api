<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Mail;

class EmailVerifyService
{
    public static function verifyEmailMethod($id,$hash)
    {

        $user = User::whereId($id)->first();
        if ($user){
            if (md5($id.$user['email'])==$hash) {
                User::whereId($id)->update(["email_verified_at"=>now()]);  
                
                return true;
            }

            return false;
        }

        return false;
    }
}