<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Mail;

class SendMailService
{
    public static function mailSend($email)
    {
        $user = User::where('email',$email)->first();
        $hash = md5($user->id.$email);
        $data = array('name'=>$user->name,'hash'=>$hash,'id'=>$user->id);
            Mail::send('verify_email', $data, function($message) use($email){
            $message->to($email, 'Administrator of armproject.am')->subject
            ('Verify email');
            $message->from('lilit4020@gmail.com','Lilitik');
        });
    }
}